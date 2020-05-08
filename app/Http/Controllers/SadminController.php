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
    public function index()
    {
        $shops = Shop::withTrashed()
        ->get();
        //return $shops;

        return view('Super-admin.indexshops', compact('shops'));
    }

    public function indexusers()
    {
        $users = User::withTrashed()
        ->get();
        //$shops = Shop()->get;;
        //return $shops;
        $branches= Auth::user()->shop->branches;
        //return $branches;
        //return $users;
        return view('Super-admin.indexusers', compact('branches', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyuser($id)
    {
        User::destroy($id);

        return  back()->with('mesage', 'El usuario ha sido dado de baja de forma exitosa!');
    }

    public function destroyshop( $id)
    {
        Shop::destroy($id);

        return back()->with('mesage', 'La tienda ha sido dada de baja de forma exitosa!');
    }

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
