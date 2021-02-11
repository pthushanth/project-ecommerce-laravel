<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * toResponse
     *
     * @param mixed $request
     *
     * @return RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        dd("dddd");
        // if (Auth::user()->role === "admin")
        //     return redirect()->route('admin');

        // return redirect()->route('client');
    }
}
