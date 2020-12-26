<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }
    function index()
    {
        return view('client.dashboard');
    }
}
