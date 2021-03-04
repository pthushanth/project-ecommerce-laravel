<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index(ReviewsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.review.index');
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $product = Product::where('slug', $slug)->first();
        $review = new Review();
        $review->review = $request->input('review');
        $review->rating = (int)$request->input('rating');
        $review->user()->associate(Auth::user());
        $review->product()->associate($product);
        $review->save();
        return back()->with('status', "Avis a été inséré avec succès.");
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        return back()->with('status', 'Le commentaire ' . $review->id . ' a été supprimée avec succès.');
    }
}
