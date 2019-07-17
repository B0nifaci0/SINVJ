<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\TrasferUser;
use App\Product;
use App\Branch;
use App\User;
use App\State;
use App\Category;
use App\Line;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;



class TrasferUserController extends Controller
{
    public function index()
       {
        $trans = TrasferUser::with('user')->with('branch')->get();
         //return response()->json($trans);
         //$status = Auth::user()->shop->id;
        //$statuses = Shop::find($status)->statuss()->get();
        /*$users=Auth::user()->shop->id;
        $trans = Shop::find('users')->trans();
        return $trans;
        if($trans == 0){
          return redirect('/traspasos/create');
        }else{
        }*/
        
        //return $transs;
        $branches=Branch::all();
        return view('transfer/TrasferUser/index', compact('branches','users','trans'));
        
       }

       public function create()
       {
        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        $products = Product::where('branch_id', $user->branch_id)->get();
        $branches = Branch::all();
        return view('transfer/TrasferUser/add', compact('branches','users','products'));
       }

       public function store(Request $request)
       {
           $transfer_user = new TrasferUser($request->all());
           //return $transfer_product;
           $transfer_user->save();
           return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
}
 
public function exportPdf(){ 
    $trans = TrasferUser::all();
    $pdf  = PDF::loadView('transfer.TrasferUser.PdfTranferUser', compact('trans'));
    return $pdf->download('Traspasos.pdf');
  }

}