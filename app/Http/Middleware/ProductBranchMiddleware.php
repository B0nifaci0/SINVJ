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
        if (Auth::user()->type_user = USER::AA) {
            return redirect('/index');
 
       }
 
       if (!Auth::user()->shop->branches) {
           
        return redirect('/index');

       }
    if (!Auth::user()->product->category) {
           
        return redirect('/index');

       }
        return $next($request);
    }
}
