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
        // return response()->json( [Auth::user()->type_user, User::AA]);
        /*if (Auth::user()->type_user != User::AA) {
            return redirect('/home');
       }**/
 
       if (Auth::user()->shop->statuss->count() == 0){
           return redirect('/status/create')->with('mesage', 'Primero debes configurar un Estatus!');
       }
        return $next($request);
    }
}
