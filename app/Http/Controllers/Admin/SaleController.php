<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\DataTables\SalesDataTable;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sale.create');
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
            'name' => 'required|unique:App\Models\Sale,name',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);

        $sale = new Sale();
        $sale->name = $request->input('name');
        // $sale->products()->attach($request->input('product_id'));
        $sale->save();
        return back()->with('status', "Le promotion " . $sale->name . " a été inséré avec succès.");
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
        $sale = Sale::find($id);
        return view('admin.pages.sale.edit')->with(['sale' => $sale]);
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
        $sale = Sale::find($id);
        $sale->name = $request->input('name');
        $sale->update();
        return back()->with('status', 'Le promotion ' . $sale->name . ' a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return back()->with('status', 'Le promotion ' . $sale->name . ' a été supprimée avec succès.');
    }
}
