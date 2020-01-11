<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Branch;
use App\Shop;

use Closure;

class ProductsBranchesMiddleware
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
        $shop = Auth::user()->shop; 
        $id_shop = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($id_shop)->branches()->get();
        return $branch;
       
       if (Product::where('branch_id',$branch)->where('deleted_at',NULL)->count() == 0) {
    
        return redirect('/productos/create')->with('mesage', 'Primero debes crear productos de esta Sucursal!');

       }
    
        return $next($request);
    }
}
