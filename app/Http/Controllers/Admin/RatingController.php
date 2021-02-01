<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RatingsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function index(RatingsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.client.index');
    }

    public function destroy($id)
    {
        $rating = Rating::find($id);
        $rating->delete();
        return back()->with('status', 'Le rating ' . $rating->id . ' a été supprimée avec succès.');
    }
}
