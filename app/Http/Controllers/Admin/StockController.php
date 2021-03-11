<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\StocksDataTable;

class StockController extends Controller
{
    public function index(StocksDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.stock.index');
    }
}
