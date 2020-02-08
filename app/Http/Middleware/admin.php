<?php

namespace App\Http\Middleware;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class admin
{
   
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

    if (Auth::user()->type_user == User::CO) {
        redirect('/traspasos');
    } else {
        redirect('/traspasosAA');
    }
        return $next($request);

    }

}
