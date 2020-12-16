<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Branch;
use App\Line;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Inicia Grafico consulta de datos, para la grafica de cantidad de usuarios por sucursal
        $user = Auth::user();
        $branches = Branch::where('shop_id', $user->shop->id)->get();
        $branches_ids = $branches->map(function ($b) {
            return $b->id;
        });

        //return $branches_ids;
        $branch_users = User::whereIn('branch_id', $branches_ids)
        ->get();

        //Inicia grafica de sucursal
        $dataBranch = Branch::join('users', 'users.branch_id', 'branches.id')
        ->whereIn('users.branch_id', $branches_ids)
        ->select('branches.id as id', 'branches.name as sucursal', DB::raw('COUNT(users.id) as Cantidad_Usuarios'))
        ->groupBy('branches.id', 'branches.name')
        ->get();
        //return $dataBranch;
        $dataLine = Line::where('shop_id', Null)
        ->select('lines.name as nombre', 'lines.purchase_price as precio_compra', 'lines.sale_price as precio_venta')
        ->get();
        //return $dataLine;

        return view('Charts/ChartJS', compact('dataBranch', 'dataLine'));
    }

}
