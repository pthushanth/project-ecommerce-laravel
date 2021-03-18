<?php

namespace App\Http\Controllers;

use App\DataTables\ClientOrdersDataTable;
use App\DataTables\ClientWishlistsDataTable;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(ClientWishlistsDataTable $dataTable)
    {
        return $dataTable->render('client.pages.wishlists');
        // dd(Wishlist::with('user', 'products')->latest()->get());
    }
    public function store($slug)
    {

        $product = Product::where('slug', $slug)->first();
        $wishlist = Wishlist::firstOrNew(['name' =>  'default']);

        $wishlist->user()->associate(Auth::user());
        // $wishlist->products()->associate($product);
        $wishlist->save();
        $wishlist->products()->attach($product->id);
        return back()->with('status', "Le produit $product->name a été ajouté à la liste d'envie avec succès.");
    }
    public function destroy($id)
    {
        $whishlist = Wishlist::findOrFail(1);
        $whishlist->products()->wherePivot('product_id', $id)->delete();
        return back()->with('status', "Le produit a été retiré de la liste d'envie avec succès.");
    }
}
