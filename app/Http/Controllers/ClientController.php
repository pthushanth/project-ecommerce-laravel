<?php

namespace App\Http\Controllers;

use App\DataTables\ClientOrdersDataTable;
use App\DataTables\ClientReviewsDataTable;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }
    function index()
    {
        return view('client.pages');
    }
    function account()
    {
        $client = User::getClient();

        // dd($client);
        return view('client.pages.account')->with('client', $client);
    }
    function accountUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:App\Models\User,email,' . Auth::user()->id,
            'avatar' => 'image',
            'address' => 'required',
            'post_code' => 'numeric',
            'city' => 'required',

        ]);

        $client = User::find(Auth::user()->id);
        $client->name = $request->input('firstname') . ' ' . $request->input('lastname');
        $client->email = $request->input('email');
        $client->customer->title = $request->input('title');
        $client->customer->lastname = $request->input('lastname');
        $client->customer->firstname = $request->input('firstname');
        $client->customer->address = $request->input('address');
        $client->customer->post_code = $request->input('post_code');
        $client->customer->city = $request->input('city');
        // dd($client->customer->address);


        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/storage/avatars/' . $filename));

            $client->avatar = $filename;
        }
        $client->customer->save();
        $client->save();
        return redirect()->back()->with(['client' => $client, 'success' => "Profile à été bien mis à jour"]);
    }

    public function orders(ClientOrdersDataTable $dataTable)
    {
        return $dataTable->render('client.pages.orders');
    }
    public function reviews(ClientReviewsDataTable $dataTable)
    {
        return $dataTable->render('client.pages.reviews');
    }
}
