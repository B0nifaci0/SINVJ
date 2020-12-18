<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Branch;
use App\Line;
use App\Status;
use App\TransferProduct;
use App\Sale;
use App\Category;
use Carbon\Carbon;
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
        $branch_users = User::whereIn('branch_id', $branches_ids)
        ->get();
        //Inicia grafica de sucursal
        $dataBranch = Branch::join('users', 'users.branch_id', 'branches.id')
        ->whereIn('users.branch_id', $branches_ids)
        ->select('branches.id as id', 'branches.name as sucursal', DB::raw('COUNT(users.id) as Cantidad_Usuarios'))
        ->groupBy('branches.id', 'branches.name')
        ->get();// termina consulta de grafica de usuarios por sucursal

        //Inica consulta de productos por status
        $user = Auth::user();
        $branches = Branch::where('shop_id', $user->shop->id)->get();
        $branches_ids = $branches->map(function ($b) {
            return $b->id;
        });
        $status = Status::where('deleted_at', Null)->get();
        $satatus_ids = $status->map(function ($b) {
            return $b->id;
        });
        $ProductStatus = Status::join('products', 'products.status_id', 'statuss.id')
        ->whereIn('products.branch_id', $branches_ids)
        ->whereIn('products.status_id', $satatus_ids)
        ->select('statuss.id as id', 'statuss.name as status', DB::raw('COUNT(products.status_id) as cantidad_status'))
        ->groupBy('statuss.id', 'statuss.name')
        ->get();
        //Termina consulya
        //Inica consulta de productos por linea
            $user = Auth::user();
            $branches = Branch::where('shop_id', $user->shop->id)->get();
            $branches_ids = $branches->map(function ($b) {
                return $b->id;
            });
            $line = Line::where('shop_id', Null)->get();
            $line_ids = $line->map(function ($b) {
                return $b->id;
            });
            $ProductLine = Line::join('products', 'products.line_id', 'lines.id')
            ->whereIn('products.branch_id', $branches_ids)
            ->whereIn('products.line_id', $line_ids)
            ->select('lines.id as id', 'lines.name as name', DB::raw('COUNT(products.line_id) as cantidad_line'))
            ->groupBy('lines.id', 'lines.name')
            ->get();
        //Termina consulya
        //Inica consulta de productos por categoria
            $user = Auth::user();
            $branches = Branch::where('shop_id', $user->shop->id)->get();
            $branches_ids = $branches->map(function ($b) {
                return $b->id;
            });
            $category = Category::where('shop_id', Null)->get();
            
            $category_ids = $category->map(function ($b) {
                return $b->id;
            });
            $ProductCategory = Category::join('products', 'products.category_id', 'categories.id')
              ->whereIn('products.branch_id', $branches_ids)
              ->whereIn('products.category_id', $category_ids)
              ->select('categories.id as id', 'categories.name as name', DB::raw('COUNT(products.category_id) as cantidad_category'))
              ->groupBy('categories.id', 'categories.name')
              ->get();
                //Termina consulya
        //Inicia consulta par agrafic de lineas
        $dataLine = Line::where('shop_id', Null)
        ->select('lines.name as nombre', 'lines.purchase_price as precio_compra', 'lines.sale_price as precio_venta')
        ->get();//termina consulta de grafica de lineas
        //Inicia Consulta Traspasos entrantes
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $transfers = TransferProduct::WhereIn('destination_user_id', $usersIds)
            ->join('branches', 'branches.id', 'transfer_products.new_branch_id')
            ->whereBetween('transfer_products.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                'branches.name as branch',
                DB::raw('count(transfer_products.id) as quantity'),
                DB::raw('date(transfer_products.created_at) as date'),
            )
            ->groupBy(['branch', 'date'])
            ->get();
        //return $transfers;//termina consulta
        //traspasos salientes
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $transfersout = TransferProduct::whereIn('user_id', $usersIds)
            ->join('branches', 'branches.id', 'transfer_products.last_branch_id')
            ->whereBetween('transfer_products.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                'branches.name as branch',
                DB::raw('count(transfer_products.id) as quantity'),
                DB::raw('date(transfer_products.created_at) as date'),
            )
            ->groupBy(['branch', 'date'])
            ->get();
        //return $transfersout;//terminaconsulta
        //cosnulta ventas
        $user = Auth()->user();
        $usersIds = User::where('shop_id', $user->shop->id)->get()->map(function ($u) {
            return $u->id;
        });

        $sales = Sale::whereIn('user_id', $usersIds)
            ->join('branches', 'branches.id', 'sales.branch_id')
            ->whereBetween('sales.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(
                'branches.name as branch',
                DB::raw('count(sales.id) as quantity'),
                DB::raw('date(sales.created_at) as date'),
            )
            ->groupBy(['branch', 'date'])
            ->get();
        //termina consultaventas

        return view('Charts/ChartJS', compact(
            'dataBranch', 'dataLine', 'transfers', 'transfersout', 
            'ProductCategory','ProductLine','sales', 'ProductStatus'));
    }

}
