<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //check if session exists and if user has admin role
        $this->auth = auth()->user() ? (auth()->user()->role === 'client') : false;

        //Pass request if auth is valid
        if ($this->auth === true) {
            return $next($request);
        }
        return redirect()->route('login')->with('error', 'Access denied. Login to continue');
    }
}
