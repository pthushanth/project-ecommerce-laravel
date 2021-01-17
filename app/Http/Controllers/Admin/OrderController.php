<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.order.index');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return back()->with('status', 'Commande ' . $order->id . ' a été supprimée avec succès.');
    }
}
