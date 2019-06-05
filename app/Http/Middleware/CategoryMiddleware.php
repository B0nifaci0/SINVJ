<?php

namespace App\Http\Middleware;
use App\User;
use App\Category;
use App\shop;

use Closure;
use Illuminate\Support\Facades\Auth;


class CategoryMiddleware
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
        if (Auth::user()->type_user = User::BUYER) {
            return redirect('/index');
 
       }
 
       if (Auth::user()->shop->id){
           return redirect('/categorias/create')->with('mesage', 'Primero debes configurar tus categorias!');
       }
        return $next($request);
    }
}
