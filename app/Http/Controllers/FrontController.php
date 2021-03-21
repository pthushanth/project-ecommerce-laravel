<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Mail\OrderMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
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
use Illuminate\Support\Facades\Mail;
use Validator;

use Stripe\Charge;
use Stripe\Stripe;

class FrontController extends Controller
{
    public function home()
    {
        $categories = Category::take(4)->get();
        $topRatedProducts = Product::with('category', 'brand')
            ->join('reviews', 'reviews.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('avg(rating) as avg_rating'))
            ->where('status', 1)
            ->groupBy('products.id')
            ->orderBy('avg_rating', 'DESC')
            ->take(10)
            ->get();

        $latestProducts = Product::with('category', 'brand')->where('status', 1)->latest()->take(10)->get();
        $saleProducts = Product::has('productSale')->with('category', 'brand', 'productSale')->where('status', 1)->latest()->take(10)->get();

        $bestSellerProducts = Product::with('category', 'brand')
            ->join('order_product', 'order_product.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('sum(order_product.qty) as totalOrderedProduct'))
            ->where('status', 1)
            ->groupBy('products.id')
            ->orderBy('totalOrderedProduct', 'DESC')
            ->take(10)
            ->get();
        // return view('front.pages.home', compact($topRatedProducts, $latestProducts));
        return view('front.pages.home')->with([
            'categories' => $categories,
            'topRatedProducts' => $topRatedProducts,
            'latestProducts' => $latestProducts,
            'bestSellerProducts' => $bestSellerProducts,
            'saleProducts' => $saleProducts
        ]);
    }
    public function products()
    {
        $categories = Category::with('products')->distinct('name')->get();
        $brands = Brand::with('products')->distinct('name')->get();
        // $ratings = Review::with('product')->groupBy('rating')->count();
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select('reviews.rating', DB::raw("count(products.id) as totalProducts"))
            ->groupBy('reviews.rating')
            ->get();
        $products = Product::with('category', 'brand')->where('status', 1)->paginate(12);
        return view('front.pages.products')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'reviews' => $reviews,

        ]);
    }
    public function filterProducts(Request $request)
    {

        $filterType = $request->input('type');
        $products = null;
        if ($filterType == "search") {
            $value = $request->input('search');
            $products = Product::with('category', 'brand')->where("name", "LIKE", "%$value%")->paginate(12);
        } else if ($filterType == "collection") {
            $collection = $request->input('collection');
            if ($collection == 'new-products') $products = Product::with('category', 'brand')->latest()->paginate(12);
            else if ($collection == 'bestseller-products') $products = Product::with('category', 'brand')
                ->join('order_product', 'order_product.product_id', '=', 'products.id')
                ->select('products.*', DB::raw('sum(order_product.qty) as totalOrderedProduct'))
                ->where('status', 1)
                ->groupBy('products.id')
                ->orderBy('totalOrderedProduct', 'DESC')
                ->paginate(12);
            else if ($collection == 'sale-products') $products = Product::has('productSale')->with('category', 'brand', 'productSale')->latest()->paginate(12);
        } else if ($filterType == "category") {
            $category_id = (int)$request->input('category');
            $products = Product::with('category', 'brand')->whereHas('category', function ($query) use ($category_id) {
                return $query->where('id', '=', $category_id);
            })->where('status', 1)->paginate(12);
        } else if ($filterType == "brand") {
            $brand_id = (int)$request->input('brand');
            $products = Product::with('category', 'brand')->whereHas('brand', function ($query) use ($brand_id) {
                return $query->where('id', '=', $brand_id);
            })->where('status', 1)->paginate(12);
        }



        $categories = Category::with('products')->distinct('name')->get();
        $brands = Brand::with('products')->distinct('name')->get();
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select('reviews.rating', DB::raw("count(products.id) as totalProducts"))

            ->groupBy('reviews.rating')
            ->get();

        return view('front.pages.products')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'reviews' => $reviews,

        ]);
    }

    public function cart()
    {
        // $content = Cart::getContent();
        // $total = Cart::getTotal();
        // return view('front.pages.cart', compact('content', 'total'));
        return view('front.pages.cart');
    }

    public function addToCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd(Cart::getContent());
        Cart::add(
            [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->name,
                'price' => $product->getRawOriginal('price'),
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
            session(['url.intended' => 'panier']);
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
        if (!Auth::user() || Auth::user()->isAdmin()) {
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
        // $aa=Order::with('user', 'deliveryAddress', 'deliveryAddressCity', 'products', 'orderStatus')->find(55);

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


        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            dd($e->getMessage());
            return redirect::to('/checkout');
        }
        Cart::clear();
        // Session::put('success', 'Achat accompli avec succès !');
        //notify new order
        // Notification::send(User::getAdmins(), new NewOrderNotification($order));
        Session::put('order', $order);

        $order = Order::with('user', 'deliveryAddress', 'products', 'orderStatus')->find($order->id);
        $email = Auth::user()->email;
        // Mail::to($email)->send(new OrderMail($order));

        OrderCreated::dispatch($order);
        // event(new OrderCreated($order));
        return redirect()->route('confirmation');
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
        $order = null;
        if (Session::has('order')) {
            $order = Session::get('order');
            Session::forget('order');
        }
        return view('front.pages.confirmation_order')->with(['order' => $order]);
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $relatedProducts = Category::with('products')->where('id', $product->category->id)->get();
        return view('front.pages.product_detail')->with(['product' => $product, 'relatedProducts' => $relatedProducts]);
    }


    public function getNewProducts()
    {
        $products = Product::with('category', 'brand')->where('status', 1)->latest()->paginate(12);
        $categories = Category::with('products')->distinct('name')->get();
        $brands = Brand::with('products')->distinct('name')->get();
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select('reviews.rating', DB::raw("count(products.id) as totalProducts"))
            ->groupBy('reviews.rating')
            ->get();

        return view('front.pages.products')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'reviews' => $reviews,
            'pageTitle' => 'Nouveauté'

        ]);
    }
    public function getBestsellerProducts()
    {
        $products = Product::with('category', 'brand')
            ->join('order_product', 'order_product.product_id', '=', 'products.id')
            ->select('products.*', DB::raw('sum(order_product.qty) as totalOrderedProduct'))
            ->where('status', 1)
            ->groupBy('products.id')
            ->orderBy('totalOrderedProduct', 'DESC')
            ->paginate(12);
        $categories = Category::with('products')->distinct('name')->get();
        $brands = Brand::with('products')->distinct('name')->get();
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select('reviews.rating', DB::raw("count(products.id) as totalProducts"))
            ->groupBy('reviews.rating')
            ->get();

        return view('front.pages.products')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'reviews' => $reviews,
            'pageTitle' => 'Meilleure ventes'

        ]);
    }

    public function getSaleProducts()
    {
        $products = Product::has('productSale')->with('category', 'brand', 'productSale')->where('status', 1)->latest()->paginate(12);
        $categories = Category::with('products')->distinct('name')->get();
        $brands = Brand::with('products')->distinct('name')->get();
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->select('reviews.rating', DB::raw("count(products.id) as totalProducts"))
            ->groupBy('reviews.rating')
            ->get();

        return view('front.pages.products')->with([
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'reviews' => $reviews,
            'pageTitle' => 'Promotion'

        ]);
    }
}
