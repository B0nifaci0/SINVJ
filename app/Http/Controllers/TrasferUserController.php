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
use App\TransferProduct;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;



class TrasferUserController extends Controller
{
    public function index()
       {
        $user = Auth::user();
        $trans = TransferProduct::where('user_id', $user->id)
          ->orWhere('destination_user_id', $user->id)
          ->with('user')->with('branch')->get();
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
        return view('transfer/TrasferUser/index', compact('branches','trans','user'));
        
       }

       public function create()
       {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->get();
        } else {
          $products = Product::join('branches', 'branches.id', 'products.branch_id')
          ->join('shops', 'shops.id', 'branches.shop_id')
          ->where('shops.id', $shop_id)
          ->select(
            'products.clave',
            //'products.name',
            'products.description',
            'products.weigth',
            'products.observations',
            'products.price',
            'products.image',
            'products.category_id',
            'products.line_id',
            'products.shop_id',
            'products.branch_id',
            'status_id',
            'branches.name as branchName',
            'branches.id as branchId'
            )
            ->get();
        }
        $users = User::where('id', '!=', $user->id)->get();
       
        $branches = Branch::all();
        return view('transfer/TrasferUser/add', compact('branches','users','products'));
       }

  public function store(Request $request)
  {
    $user = Auth::user();
    
    $transfer_product = new TransferProduct([
      'user_id' => $user->id,
      'last_branch_id' => $request->branch_id,
      'new_branch_id' => $request->new_branch_id,
      'product_id' => $request->product_id,
      'destination_user_id' => $request->destination_user_id,
      'status_product' => null
    ]);
    //return $transfer_product;
    $transfer_product->save();
    return redirect('/traspasosAA')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
  }
 
  public function exportPdf(){ 
    $trans = TrasferUser::all();
    $pdf  = PDF::loadView('transfer.TrasferUser.PdfTranferUser', compact('trans'));
    return $pdf->download('Traspasos.pdf');
  }

}