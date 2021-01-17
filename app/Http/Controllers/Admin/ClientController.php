<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientsDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.client.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('status', 'Le client ' . $user->name . ' a été supprimée avec succès.');
    }
}
