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
        if (Auth::user()->type_user = User::AA) {
            return redirect('/index');
       }
 
       if (Auth::user()->shop->categories->count() == 0){
           return redirect('/categorias/create')->with('mesage', 'Primero debes configurar una categoria!');
       }else{
           //return ('Primero debes configurar tu categoria!');
           redirect('/productos/create');
       }
        return $next($request);
    }
}
