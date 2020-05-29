<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Auth;
use App\Line;

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
       $user = Auth::user();
       // return response()->json([Auth::user()->shop->lines->count(), 1]);
       if (Auth::user()->shop->lines->count() == 0){
           return redirect('/lineas/create')->with('mesage', 'Primero debes configurar tu linea!');
       }
       $group = $user->shop->shop_group_id;
       if (Line::where('shop_group_id', $group)->count() == 0 && $user->admin_group == User::ADMIN_GROUP){
           return redirect('/lineas/create')->with('mesage', 'Primero debes configurar una linea para tu grupo!');
       }
        return $next($request);
    }
}
