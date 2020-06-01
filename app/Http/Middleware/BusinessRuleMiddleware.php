<?php

namespace App\Http\Middleware;
use App\User;
use App\Category;
use App\Shop;
use App\BusinessRule;

use Closure;
use Illuminate\Support\Facades\Auth;


class BusinessRuleMiddleware
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
       }**/
       $user = Auth::user();
       if (BusinessRule::where('shop_id', $user->shop_id)->count() == 0){
           return redirect('/businessrules/create')->with('mesage', 'Primero debes configurar una regla de descuento para tus categorias!');
       }
       $group = $user->shop->shop_group_id;
       if (BusinessRule::where('shop_group_id', $group)->count() == 0 && $user->admin_group == User::ADMIN_GROUP){
           return redirect('/businessrules/create')->with('mesage', 'Primero debes configurar una regla de descuento para las categorias del grupo!');
       }
        return $next($request);
    }
}
