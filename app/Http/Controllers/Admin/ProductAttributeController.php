<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\DataTables\ProductAttributesDataTable;
use App\Models\Category;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductAttributesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.attribute.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:App\Models\Attribute,name',

        ]);

        $attribute = new Attribute();
        $attribute->name = $request->input('name');
        $categories_id = $request->input('categories');
        $category_id_array = array();
        foreach ($categories_id as $id) {

            //collect all inserted record IDs
            $category_id_array[] = $id;
        }
        // $attribute->categories()->sync($category_id_array, false); //dont delete old entries = false
        // $attribute->products()->attach($request->input('product_id'));
        $attribute->save();
        $attribute->categories()->sync($category_id_array);

        return back()->with('status', "L'attribut " . $attribute->name . " a été inséré avec succès.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('admin.pages.attribute.create')->with(['attribute' => $attribute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute = Attribute::find($id);
        $attribute->name = $request->input('name');
        $attribute->update();
        return back()->with('status', 'L\'attribut ' . $attribute->name . ' a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        $attribute->delete();
        return back()->with('status', 'L\'attribut ' . $attribute->name . ' a été supprimée avec succès.');
    }

    public function getCategoryAttributes(Request $request)
    {
        $category_attributes = Category::with('attributes')->find($request->category_id);

        return response()->json([
            'attributes' => $category_attributes->attributes
        ]);
    }
}
