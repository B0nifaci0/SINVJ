<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class Product
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
        if (Auth::user()->type_user = USER::AA) {
            return redirect('/index');
 
       }
       if (Auth::user()->shop->branch == ''){
           return redirect('/sucursales/create')->with('mesage', 'Primero debes configurar tu sucursal!');
       }
        return $next($request);
    }
} 
