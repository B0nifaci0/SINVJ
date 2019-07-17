<?php

namespace App\Http\Middleware;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class admin
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
    if (Auth::user()->type_user == USER::CO) {
        return redirect('traspasos');

   }else{
        //return ('Primero debes configurar tu linea!');
        redirect('traspasosadmin');
    }
        return $next($request);
    }
}
