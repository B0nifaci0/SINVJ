<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Auth;
use Line;

class LineMiddleware
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
       }*/
 
       // return response()->json([Auth::user()->shop->lines->count(), 1]);
       if (Auth::user()->shop->lines->count() == 0){
           return redirect('/lineas/create')->with('mesage', 'Primero debes configurar tu linea!');
       }else{
           //return ('Primero debes configurar tu linea!');
           redirect('/productos/create');
       }
        return $next($request);
    }
}
