<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\DataTables\ProductSalesDataTable;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductSalesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.product_sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product_sale.create');
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
            'products' => 'required',
            'is_percentage' => 'required',
            'discount_value' => 'required|unique:App\Models\Sale,name',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);
        $product_slug = $request->input('products')['0'];
        $product = Product::where('slug', $product_slug)->first();
        $productSale = new ProductSale();
        $productSale->is_percentage =  (int) $request->input('is_percentage');
        $productSale->discount_value = $request->input('discount_value');
        $productSale->start = $request->input('start');
        $productSale->end = $request->input('end');
        $productSale->product_id = $product->id;
        $productSale->save();
        return back()->with('status', "Le promotion " . $product->name . " a été inséré avec succès.");
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
        $productSale = ProductSale::find($id);
        return view('admin.pages.product_sale.create')->with(['sale' => $productSale]);
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
        // dd($request->input('products')['0']);
        $product = Product::where('slug', $request->input('products')['0'])->first();
        $productSale = ProductSale::find($id);
        $productSale->name = $request->input('name');
        $productSale->is_percentage =  (int) $request->input('is_percentage');
        $productSale->discount = $request->input('discount');
        $productSale->start = $request->input('start');
        $productSale->end = $request->input('discount');
        $productSale->product_id = $product->id;
        return back()->with('status', 'Le promotion ' . $product->name . ' a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productSale = ProductSale::find($id);
        $productSale->delete();
        return back()->with('status', 'Le promotion ' . $productSale->id . ' a été supprimée avec succès.');
    }
}
