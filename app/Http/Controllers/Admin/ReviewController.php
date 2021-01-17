<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index(ReviewsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.review.index');
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        return back()->with('status', 'Le commentaire ' . $review->id . ' a été supprimée avec succès.');
    }
}
