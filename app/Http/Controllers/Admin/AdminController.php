<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    function index()
    {
        $nbClients = $this->getNbClient();
        $totalIncome = $this->getTotalIncome();
        $totalOrders = $this->getTotalOrders();
        $distinctProducts = $this->getDistinctProducts();
        return view('admin.pages.dashboard')
            ->with([
                'nbClients' => $nbClients,
                'totalIncome' => $totalIncome,
                'totalOrders' => $totalOrders,
                'distinctProducts' => $distinctProducts
            ]);
    }

    private function getNbClient()
    {
        $client = new User();
        return $client->getClients()->count();
    }

    private function getTotalIncome()
    {
        return Order::get()->sum('amount');
    }

    private function getTotalOrders()
    {
        return Order::get()->count();
    }

    private function getDistinctProducts()
    {
        return Product::distinct()->get()->count();
    }
}
