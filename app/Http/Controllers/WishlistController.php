<?php

namespace App\Http\Controllers;

use App\DataTables\ClientOrdersDataTable;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(ClientOrdersDataTable $dataTable)
    {
        return $dataTable->render('client.pages.whislists');
    }
    public function store($slug)
    {

        $product = Product::where('slug', $slug)->first();
        $wishlist = Wishlist::firstOrNew(['name' =>  'default']);

        $wishlist->user()->associate(Auth::user());
        $wishlist->products()->associate($product);
        $wishlist->save();
        return back()->with('status', "Le produit $product->name a été ajouté à la liste d'envie avec succès.");
    }
    public function destroy($id)
    {
        $whishlist = Wishlist::findOrFail(1);
        $whishlist->products()->where('id', $id)->delete();
        return back()->with('status', "Le produit a été retiré de la liste d'envie avec succès.");
    }
}
