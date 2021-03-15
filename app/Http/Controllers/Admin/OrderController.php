<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Notifications\NewOrderNotification;
use App\Notifications\OrderStatusUpdateNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.order.index');
    }
    public function edit($id)
    {
        $order = Order::find($id);
        $orderStatuses  = OrderStatus::get();
        return view('admin.pages.order.edit')->with(['order' => $order, 'orderStatuses' => $orderStatuses]);
    }
    public function update(Request $request, $id)
    {
        $order = Order::with('user', 'orderStatus')->find($id);
        $order->order_status_id = $request->input('order_status');
        $order->user->notify(new OrderStatusUpdateNotification($order));
        return back()->with('status', 'L\'état de la commande ' . $order->id . ' a été mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return back()->with('status', 'Commande ' . $order->id . ' a été supprimée avec succès.');
    }
}
