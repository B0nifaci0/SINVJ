<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shop;
use App\User;
use App\branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\S3ImageManager;

class SadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //FUNCION PARA INDEX DE TIENDAS//
    public function index()
    {
        $shops = Shop::withTrashed()
        ->get();
        //return $shops;


        return view('Super-admin.indexshops', compact('shops'));
    }
    //FUNCION PARA USUARIOS UNICAMENTE ADMINISTRADORES DE LAS TIENDAS
    public function indexusers()
    {
        $users = User::withTrashed()
        ->where('type_user', 1)
        ->get();

        $branches= Auth::user()->shop->branches;
        
        //return $branches;
        //return $users;
        return view('Super-admin.indexusers', compact('branches', 'users'));
    }

    //FUNCION PARA INDEX SUCURSALES POR TIENDA
    public function indexbranches($id){

        $shop = Shop::where('id',$id)
        ->get();

        $branch = Branch::where('shop_id', $id)
        ->withTrashed()
        ->get();
        
        //return $branch;
        
        return view('Super-admin.indexbranches', compact('branch','shop'));
    }

    //FUNCION PARA USUARIOS POR TIENDA
    public function indexusershop($id){
        $shop = Shop::where('id',$id)
        ->get();

        $users = User::where('shop_id', $id)
        ->whereIn ('type_user', [2,3])
        ->withTrashed()
        ->get();

        //return $users;

        return view('Super-admin.usershop', compact('shop','users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //FUNCION PARA BAJA LÓGICA DE USUARIOS
    public function destroyuser($id)
    {
        User::destroy($id);

        return  back()->with('mesage', 'El usuario ha sido dado de baja de forma exitosa!');
    }

    //FUNCION PARA BAJA LÓGICA DE TIENDAS
    public function destroyshop( $id)
    {
        Shop::destroy($id);

        return back()->with('mesage-delete', 'La tienda ha sido dada de baja de forma exitosa!');
    }

    //FUNCION PARA RESTAURAR USUARIOS
    public function restoreuser( $id )
    {

        //Indicamos que la busqueda se haga en los registros eliminados con withTrashed
        $user = User::withTrashed()->where('id',$id)->get();
        //return $user;
        foreach ($user as $u) {
            $u->deleted_at = null;
            $u->save();
        }
        //return $product;

        return back()->with('mesage', 'El usuario ha sido reactivado de forma exitosa!');   
    }

    //FUNCION PARA RESTAURAR TIENDAS
    public function restoreshop( $id)
    {
        $shop = Shop::withTrashed()->where('id', $id)->get();
        //return $shop; 
        foreach ($shop as $s){
            $s->deleted_at = null;
            $s->save();
        }

        return back()->with('mesage', 'La tienda ha sido reactivada de forma exitosa!');

    }
}
