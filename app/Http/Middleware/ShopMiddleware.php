<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class ShopMiddleware
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
        /* if (Auth::user()->type_user == User::AA) {
             return redirect('/index');

        }

        if (Auth::user()->shop == '') {
            return redirect('/tiendas/create')->with('mesage', 'Primero debes configurar tu tienda!');
        }*/
        return $next($request);
    }
}
 