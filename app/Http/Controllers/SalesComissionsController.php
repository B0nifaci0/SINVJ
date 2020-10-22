<?php

namespace App\Http\Controllers;

use PDF;
use App\Sale;
use App\User;
use App\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SalesComissionsController extends Controller
{
    use S3ImageManager;
    public function index()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        $branches = Branch::where('shop_id', '=', $user->shop->id)->get();
        $branch_ids = $branches->map(function ($b) {
            return $b->id;
        });
        // return $branch_ids;

        $users = User::where('id', '!=', $user->id)
            ->where('branch_id', $branch_ids)
            ->get();
        // return $users;

        return view('User/Comission/index', compact('branches', 'users'));
    }

    public function reportcomission()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        $branches = Branch::where('shop_id', '=', $user->shop->id)->get();
        $branch_ids = $branches->map(function ($b) {
            return $b->id;
        });
        // return $branch_ids;

        $users = User::where('id', '!=', $user->id)
            ->whereIn('branch_id', $branch_ids)
            ->get();
        // return $users;

        return view('User/Comission/index', compact('branches', 'users'));
    }

    //**  */
    public function ComissionBranchPDF(Request $request)
    {
        $branch = $request->sucursal;
        $branches = Branch::select('*')
            ->where('id', $branch)
            ->get();
        $users = User::select('*')
            ->where('branch_id', $branch)
            ->get();
        //return $users;
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $shops = Auth::user()->shop()->get();

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $sales = Sale::join('users', 'users.id', 'sales.user_id')
            ->select(DB::raw('SUM(sales.total * 0.01) as ventas'))
            ->whereBetween('sales.created_at', [$fecini, $fecter])
            ->where('sales.branch_id', $branch)
            ->get();

        $fecini->addDay();
        $fecter->subDay();
        $pdf  = PDF::loadView('User.Comission.ComisionBranchPDF', compact('sales', 'users', 'branches', 'shop', 'hour', 'dates', 'shops','fecini','fecter'));
        return $pdf->stream('ReporteComisionUsuario.pdf');
    }

    //**  */
    public function ComissionUserPDF(Request $request)
    {

        $branch = $request->sucursal;
        $branches = Branch::select('*')
            ->where('id', $branch)
            ->get();
        //return $branches;
        $user = $request->user;
        $shop = Auth::user()->shop;
        $hour = Carbon::now();
        $hour = date('H:i:s');
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $shops = Auth::user()->shop()->get();

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $sales = Sale::join('users', 'users.id', 'sales.user_id')
            ->select('users.id', 'users.name as username', DB::raw('SUM(sales.total * 0.01) as ventas'))
            ->whereBetween('sales.created_at', [$fecini, $fecter])
            ->where('sales.branch_id', $branch)
            ->where('sales.user_id', $user)
            ->groupBy('users.id', 'users.name')
            ->get();
        //return $sales;
        $fecini->addDay();
        $fecter->subDay();

        $pdf  = PDF::loadView('User.Comission.ComisionUserPDF', compact('fecini','fecter','dates', 'branches', 'sales', 'user', 'branch', 'shop', 'hour', 'dates', 'shops'));
        return $pdf->stream('ReporteComisionUsuario.pdf');
    }
}
