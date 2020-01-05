<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\TransferProduct;
use App\Product;
use App\Branch;
use App\User;
use App\State;
use App\Category;
use App\Line;
use Carbon\Carbon;
use PDF;
use DB;
use Auth;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\Storage;



class TranferProductsController extends Controller
{
  use S3ImageManager;
    public function __construct(){
    }
    public function index()
       {
        $user = Auth::user();

        $trans = TransferProduct::where('user_id', $user->id)
          ->orWhere('destination_user_id', $user->id)
          ->orWhere('last_branch_id', $user->branch->id)
          ->orWhere('new_branch_id', $user->branch->id)
          ->with('user')->with('branch')->with('product')->get();
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
        // return view('transfer/TrasferUser/index', compact('branches','trans','user'));
        return view('transfer/index', compact('branches','user','trans'));
        
       }
       public function indexAA()
       {
        
        $user = Auth::user();
        $trans = TransferProduct::all();
        
          // return ['new_branch_id', $user->branch_id];
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
        return view('transfer/TrasferUser/index', compact('branches','user','trans'));
        
       }
       public function createAA()
       {
        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        return $users;
        $products = Product::where('branch_id', $user->branch_id)->get();
        $branches = Branch::all();
        return view('transfer/TrasferUser/add', compact('branches','users','products'));
       }
       

       public function create()
       {
        $user = Auth::user();
        $shop = $user->branch->shop;
        $users = User::where('id', '!=', $user->id)->get();
        $products = Product::where('branch_id', $user->branch_id)->get();
        
        if($user->shop && $user->shop->shop_group_id) {
          $shop_ids = Shop::where('shop_group_id', $user->shop->shop_group_id)->get()->map(function($item) { return $item->id;  });
          $branches = Branch::whereIn('shop_id', $shop_ids)
          ->get();
        } else {
          $branches = Branch::where('shop_id', $user->shop->id)
          // ->where('id', '!=', $user->branch_id)
          ->get();
        }
        
        $branch_ids = $branches->map(function($b) { return $b->id; });
        
        $user = Auth::user(); //Retorna el usuario con el que se encuentra logueado 
        $users = User::where('id', '!=', $user->id)->get(); // Retorna los usuarios que pertenecen a la tienda y no estan logueados
        //return $users;
        $products = Product::where('branch_id', $user->branch_id)
        ->get(); //Retorna todos los productos de la tienda solo si el usuario tiene
        return view('transfer/add', compact('branches','users','products','user'));
       }

       public function show()
       {
       return view('transfer.show');
       }

	public function store(Request $request)
    {
    	$user = Auth::user();
    	$data = $request->all();
    	$data['last_branch_id']  = $user->branch_id;
    	$data['user_id'] = $user->id;
    	$data['status_product'] = null;

    	$transfer_product = TransferProduct::create($data);

    	$product = Product::find($request->product_id);
		  // $product->status_id = 3;
		  // $product->save();

    	return redirect('/traspasos')->with('mesage', 'El Traspaso se ha agregado exitosamente!');
    }

  public function answerTransferRequest(Request $request) {
    $user = Auth::user();
    $transfer = TransferProduct::find($request->transfer_id);
    $product = Product::find($transfer->product_id);

    if($request->answer === null) {
      $transfer->delete();
    } else {
      $transfer->status_product = $request->answer;
      $transfer->save(); 
      if($request->answer) {
        $product->branch_id = $transfer->new_branch_id;
        // $product->status_id = 2;
	    	$product->status_id = 3;
        $product->shop_id = $user->shop->id;
        $product->save();
      }
    }
    if($user->type_user == User::AA || $user->type_user == User::SA) {
      return redirect('/traspasosAA');
    } else {
      return redirect('/traspasos');
    }
  }

  public function payTransfer(Request $request) {
    $transfer = TransferProduct::find($request->transfer_id);
    $transfer->paid_at = Carbon::now()->format('Y-m-d');
    $transfer->save();
    return back();
  }

  public function giveBack(Request $request) {
	$transfer = TransferProduct::find($request->transfer_id);
	
	$product = Product::where('id', $transfer->product_id)->first();
  $product->branch_id = $transfer->last_branch_id;
  $product->status_id = 2;
	$product->save();
    $transfer->delete();
	
    return back();
  }
  
public function exportPdfall(){ 
  $user = Auth::user();
        $date= date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $branches = $user->shop->branches;
        $shop = Auth::user()->shop;
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
    $trans = TransferProduct::all();
    $pdf  = PDF::loadView('transfer.PdfTranferall', compact('trans','date','hour','shop'));
    $pdf->setpaper('letter', 'landscape');
    return $pdf->stream('Traspasos.pdf');  
  }

    public function exportPdf($id){
     // return $id;
     $user = Auth::user();
     $shop = Auth::user()->shop;
        if($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
    $trans = TransferProduct::where("id","=",$id)->get();
    $pdf  = PDF::loadView('transfer.PdfTranfer', compact('trans'));
    return $pdf->stream('Traspaso.pdf');  
  }

}

//reporte de gastos
//reporte de productos por sucursal 
//Que aparesca el crud de elimina y edita en sucursales productos