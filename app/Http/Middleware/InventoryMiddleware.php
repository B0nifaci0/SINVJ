<?php
namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;
use branches;


use Closure;

class InventoryMiddleware
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
         
       if (Auth::user()->shop->branches->count() == 0 ){
           return redirect('/productos/create')->with('mesage', 'Primero debes configurar los productos de tu Sucursal!');
       }
    return $next($request);

    }
}
