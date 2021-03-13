<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\DataTables\CouponsDataTable;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.coupon.create');
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
            'code' => 'required|unique:App\Models\Coupon,code',
            'start' => 'required|date',
            'end' => 'required|date',
            'discount_type' => 'required',
            'discount_value' => 'required',
        ]);

        $coupon = Coupon::create($request->all());
        $coupon->save();
        return back()->with('status', "Le coupon " . $coupon->code . " a été inséré avec succès.");
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
        $coupon = Coupon::find($id);
        return view('admin.pages.coupon.create')->with(['coupon' => $coupon]);
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

        $coupon = Coupon::find($id);
        $coupon->update($request->all());
        return back()->with('status', 'Le coupons ' . $coupon->value . ' a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return back()->with('status', 'L\'attribut ' . $coupon->name . ' a été supprimée avec succès.');
    }
}
