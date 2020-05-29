<?php

namespace App\Http\Middleware;
use App\User;
use App\Category;
use App\Shop;

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
        /* if (Auth::user()->type_user == User::AA) {
            return redirect('/index');
       }**/
       $user = Auth::user();
       if (Auth::user()->shop->categories->count() == 0){
           return redirect('/categorias/create')->with('mesage', 'Primero debes configurar una categoria!');
       }
       $group = $user->shop->shop_group_id;
       if (Category::where('shop_group_id', $group)->count() == 0 && $user->admin_group == User::ADMIN_GROUP){
           return redirect('/categorias/create')->with('mesage', 'Primero debes configurar una categoria para tu grupo!');
       }
        return $next($request);
    }
}
