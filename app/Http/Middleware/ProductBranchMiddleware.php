<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;


use Closure;

class ProductBranchMiddleware
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
        if (Auth::user()->type_user = USER::BUYER) {
            return redirect('/index');
 
       }
 
       if (Auth::user()->shop->branch != '') {
           return redirect('/productos');
       }
        return $next($request);
    }
}
