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

     //**  */
    public function ComissionBranchPDF(){
        $branches= Auth::user()->shop->branches;
        $shop = Auth::user()->shop;
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        } 
        $hour = Carbon::now();
        $hour = date('H:i:s');
          $dates = Carbon::now();
          $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();

  
      $pdf  = PDF::loadView('User.Comission.ComisionBranchPDF', compact('branches','shop','hour','dates','shops'));
      return $pdf->stream('ReporteComisionUsuario.pdf');
    }

    //**  */
    public function ComissionUserPDF(){

        $branches= Auth::user()->shop->branches;
        $shop = Auth::user()->shop; 
        $hour = Carbon::now();
        $hour = date('H:i:s');
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
          $dates = Carbon::now();
          $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();

  
      $pdf  = PDF::loadView('User.Comission.ComisionUserPDF', compact('branches','shop','hour','dates','shops'));
      return $pdf->stream('ReporteComisionUsuario.pdf');
    }

}
