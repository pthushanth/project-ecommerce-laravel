<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

use Stripe\Charge;
use Stripe\Stripe;

class FrontController extends Controller
{
    public function home()
    {
        // $topRatedProducts = Product::with('category', 'brand', 'rating')->avg()->get();
        // $topRatedProducts = Product::with('category', 'brand', 'rating')
        //     ->select('products.*', DB::raw('avg(star)'))->groupBy('id')->orderBy('star', 'DESC')->get();
        // dd($topRatedProducts);

        // $topRatedProducts = Rating::with('product.category', 'product.brand')->groupBy('product_id')->orderBy(avg('star'))->get();
        $topRatedProducts = Product::with('category', 'brand')
            ->join('ratings', 'ratings.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('avg(star) as avg_star'))
            ->groupBy('products.id')
            ->orderBy('avg_star', 'DESC')
            ->take(10)
            ->get();
        // dd($topRatedProducts->category);
        $latestProducts = Product::with('category', 'brand')->latest()->take(10)->get();
        // return view('front.pages.home', compact($topRatedProducts, $latestProducts));
        return view('front.pages.home')->with(['topRatedProducts' => $topRatedProducts, 'latestProducts' => $latestProducts]);
    }
    public function products()
    {
        $products = Product::with('category', 'brand')->paginate(12);
        return view('front.pages.products')->with('products', $products);
    }

    public function cart()
    {
        // $content = Cart::getContent();
        // $total = Cart::getTotal();
        // return view('front.pages.cart', compact('content', 'total'));
        return view('front.pages.cart');
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        // dd(Cart::getContent());
        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => intval($request->quantity),
                'attributes' => [],
                'associatedModel' => $product,
            ]
        );

        return redirect()->back()->with('cart', 'ok');
    }

    public function updateCart(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => ['relative' => false, 'value' => $request->quantity],
        ]);
        return redirect(route('cart'));
    }


    public function deleteItemCart($id)
    {
        Cart::remove($id);
        return redirect(route('cart'));
    }

    public function couponReduction(Request $request)
    {
        if (!Auth::user()) {
            //session to store where to redirect after login
            session(['url.intended' => 'cart']);
            return view('auth.login');
        }
        $request->validate([
            'coupon' => 'required'
        ]);
        $coupon = Coupon::where('code', $request->input('coupon'))
            ->where('end', '>=', Carbon::now()->format('Y/m/d H:i:s'))
            ->where('start', '<=', Carbon::now()->format('Y/m/d H:i:s'))
            ->first();

        if ($coupon == null) {
            return redirect(route('cart'))->withFail('Désolé, le code n\'est pas valable');
        }

        $value = null;
        if ($coupon->discount_type == 'fixed') $value = '-' . $coupon->discount_value;
        if ($coupon->discount_type == 'pourcentage') $value = '-' . $coupon->discount_value . '%';

        if (!Cart::getConditions()->isEmpty()) {
            Cart::clearCartConditions();
        }
        $condition = new CartCondition(array(
            'name' => $coupon->code,
            'type' => 'coupon',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $value
        ));
        Cart::condition($condition);
        // $total = Cart::getSubTotal();
        // $couponUsed = Cart::getCondition('coupon');
        // $newTotal = $couponUsed->getCalculatedValue($total);
        // dd($newTotal);

        return redirect(route('cart'))->withSuccess('Reduction bien appliquée');
    }

    public function checkout()
    {
        if (!Auth::user()) {
            //session to store where to redirect after login
            session(['url.intended' => 'checkout']);
            return view('auth.login');
        }
        if (Cart::isEmpty()) {
            return view('front.pages.cart');
        }

        $deliveryAddresses = DeliveryAddress::with('city')->where('user_id', Auth::user()->id)->get();
        return view('front.pages.checkout')->with('deliveryAddresses', $deliveryAddresses);
    }

    public function checkoutPay(Request $request)
    {
        if (Cart::isEmpty()) {
            return view('front.pages.cart');
        }

        Stripe::setApiKey('sk_test_51Hkyc3H45Efq8ulYspcvIsk1Y0LnA78QDXYdnv3430jkXj43zTiZfZfRlvr18aRxnFnzgUuOEfnx65LJrz55PXMY00ZBLsBQ8V');
        try {

            $charge = Charge::create(array(
                "amount" => Cart::getTotal() * 100,  //multiplied by 100 because amount must be cent
                "currency" => "eur",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            // $order->user_id = $request->input('name');
            $order->user_id =  Auth::user()->id;

            $order->payment_id = $charge->id;
            $order->currency = 'EUR';
            $order->order_status_id = 1;
            $order->amount = Cart::getTotal();
            $order->payment_status = 'accepted';

            $attachProduct = array();
            foreach (Cart::getContent() as $item) {
                $attachProduct[$item->model->id] = [
                    'qty'  => $item->quantity
                ];
            }
            if (!empty($request->input('deliveryAddress'))) {
                $order->delivery_address_id = $request->input('deliveryAddress');
            } else {
                $idAddress = $this->createDeliveryAddress($request);
                $order->delivery_address_id = $idAddress;
            }
            $order->save();
            $order->products()->attach($attachProduct);

            if (Cart::getConditions()->first()) {
                $coupon = Coupon::where('code', Cart::getConditions()->first()->getName())->first();
                $order->coupons()->attach($coupon->id);
            }
            // $orders = Order::where("payment_id", $charge->id)->get();

            //$email = Session::get('client')->email;

            // Mail::to($email)->send(new SendMail($orders));
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            dd($e->getMessage());
            return redirect::to('/checkout');
        }
        Cart::clear();
        Session::put('success', 'Purchase accomplished successfully !');
        //notify new order
        Notification::send(User::getAdmin(), new NewOrderNotification($order));

        return redirect()->route('confirmation')->with('status', 'Achat accompli avec succès');
    }


    private function createDeliveryAddress($input)
    {
        $city = City::where('post_code', $input->input('post-code'))->first();
        if (empty($city)) {
            $city = new City();
            $city->post_code = $input->input('post-code');
            $city->city = $input->input('city');
            $city->save();
        }
        $deliveryAddress = new DeliveryAddress();

        $deliveryAddress->title = "M";
        $deliveryAddress->last_name = $input->input('lastname');
        $deliveryAddress->first_name = $input->input('firstname');
        $deliveryAddress->address = $input->input('address');
        $deliveryAddress->user_id = Auth::user()->id;
        $deliveryAddress->city_id = $city->id;
        $deliveryAddress->save();

        return $deliveryAddress->id;
    }


    public function confirmation()
    {
        return view('front.pages.confirmation_order');
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        $relatedProducts = Category::with('products')->where('id', $product->category->id)->get();
        return view('front.pages.product_detail')->with(['product' => $product, 'relatedProducts' => $relatedProducts]);
    }
}
