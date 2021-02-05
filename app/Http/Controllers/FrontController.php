<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Cart;
use Validator;

class FrontController extends Controller
{
    public function home()
    {
        return view('front.pages.home');
    }
    public function products()
    {
        $products = Product::with('category', 'brand')->paginate(12);
        return view('front.pages.products')->with('products', $products);
    }

    public function cart()
    {
        $content = Cart::getContent();
        $total = Cart::getTotal();
        return view('front.pages.cart', compact('content', 'total'));
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
}
