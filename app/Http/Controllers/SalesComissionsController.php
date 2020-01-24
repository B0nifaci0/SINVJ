<?php

namespace App\Http\Controllers;

use PDF;
use App\Line;
use App\Sale;
use App\Shop;
use App\User;
use App\State;
use App\Branch;
use App\Status;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;


class SalesComissionsController extends Controller
{
    use S3ImageManager;
    public function index()
    {     
      $user = Auth::user();
        $shop_id = $user->shop->id;
        $branches = Branch::where('shop_id', '=', $user->shop->id)->get();
        $branch_ids = $branches->map(function($b) { return $b->id; });
       // return $branch_ids;
        
        $users = User::where('id', '!=', $user->id)
          ->where('branch_id', $branch_ids)
          ->get();
       // return $users;

      return view('User/Comission/index',compact('branches','users'));
     }

     public function reportcomission()
    {     
      $user = Auth::user();
        $shop_id = $user->shop->id;
        $branches = Branch::where('shop_id', '=', $user->shop->id)->get();
        $branch_ids = $branches->map(function($b) { return $b->id; });
       // return $branch_ids;
        
        $users = User::where('id', '!=', $user->id)
          ->where('branch_id', $branch_ids)
          ->get();
       // return $users;

      return view('User/Comission/index',compact('branches','users'));
     }

     //**  */
    public function ComissionBranchPDF(Request $request){
      $branch = $request->sucursal;
      $branches = Branch::select('*')
      ->where('id',$branch)
      ->get();
      $users = User::select('*')
          ->where('branch_id', $branch)
          ->get();
      //return $users;
        $shop = Auth::user()->shop;
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        } 
        $hour = Carbon::now();
        $hour = date('H:i:s');
          $dates = Carbon::now();
          $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();



      $sales = Sale::join('users','users.id','sales.user_id')
      ->select(DB::raw('SUM(sales.total * 0.01) as ventas'))
      ->where('sales.branch_id',$branch)
      ->get();
  
      $pdf  = PDF::loadView('User.Comission.ComisionBranchPDF', compact('sales','users','branches','shop','hour','dates','shops'));
      return $pdf->stream('ReporteComisionUsuario.pdf');
    }

    //**  */
    public function ComissionUserPDF(Request $request){

        $branch = $request->sucursal;
        $branches = Branch::select('*')
        ->where('id',$branch)
        ->get();
        //return $branches;
        $user = $request->user;
        $shop = Auth::user()->shop; 
        $hour = Carbon::now();
        $hour = date('H:i:s');
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
          $dates = Carbon::now();
          $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();

        $comission = User::where('id',$user)
        ->select(DB::raw('SUM(comision / 100) as comissions'));
        //return $comission;

        //$number1 = (int)$comission;

        //return $user;

        $sales = Sale::join('users','users.id','sales.user_id')
        ->select('users.id','users.name as username',DB::raw('SUM(sales.total * 0.01) as ventas'))
        ->where('sales.branch_id',$branch)
        ->where('sales.user_id',$user)
        ->groupBy('users.id', 'users.name')
        ->get();
        //return $sales;
  
      $pdf  = PDF::loadView('User.Comission.ComisionUserPDF', compact('dates','branches','sales','user','branch','shop','hour','dates','shops'));
      return $pdf->stream('ReporteComisionUsuario.pdf');
    }

}
