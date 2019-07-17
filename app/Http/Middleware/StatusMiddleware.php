<?php

namespace App\Http\Middleware;
use Auth;
use App\User;

use Closure;

class StatusMiddleware
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
 
       if (Auth::user()->shop->statuss->count() == 0){
           return redirect('/status/create')->with('mesage', 'Primero debes configurar un Estatus!');
       }else{
           //return ('Primero debes configurar tu linea!');
           redirect('/productos/create');
       }
        return $next($request);
    }
}
