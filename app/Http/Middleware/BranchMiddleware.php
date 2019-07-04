<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;
use branches;


use Closure;

class BranchMiddleware
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
        return redirect('/');
        }
 
       if (Auth::user()->shop->branches->count() == 0 ){
           return redirect('/sucursales/create')->with('mesage', 'Primero debes configurar tu Sucursal!');
       }
    return $next($request);

    }
}
