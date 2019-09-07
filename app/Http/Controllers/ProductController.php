<?php

namespace App\Http\Controllers;

use App\State;
use App\Product;
use App\Category;
use App\Shop;
use App\Line;
use App\Branch;
use App\Status;
use App\User;
use App\Sale;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

  public function __construct(){

  }
/** FUNCIONES PARA CRUD DE PRODUCTO */
  public function index()
  { 
    $user = Auth::user();
  
      
      $shop_id = $user->shop->id;
      if($user->type_user == User::CO) {
        $products = Product::where('branch_id', $user->branch_id)->get();
      } else {
        $products = Shop::find($shop_id)->products()->get();
      }
      //return $products; 
      //$categories = Category::all();
      $shops = Auth::user()->shop()->get();
      //return $shops;
      $category = Auth::user()->shop->id;  
      $categories = Shop::find($category)->categories()->get();
      $line = Auth::user()->shop->id; 
      $lines = Shop::find($line)->lines()->get();
      //return $lines;  
      $status = Auth::user()->shop->id;
      $statuses = Shop::find($status)->statuss()->get();

      return view('product/index', compact('user','categories','lines','shops','statuses','products'));
  }
    
    public function indexCOP()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->get();
        } else {
          $products = Shop::find($shop_id)->products()->get();
        }
        //return $products; 
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
        $line = Auth::user()->shop->id; 
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();

        return view('product/index', compact('user', 'categories','lines','shops','statuses','products'));
    }

    public function indexCO()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        $products = Shop::find($shop_id)->products()->get();
        //return $products;
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
        $line = Auth::user()->shop->id; 
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();

        return view('product/productCO/index', compact('user', 'categories','lines','shops','statuses','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Auth::user()->shop->id;
        //return $category;
        $user = Auth::user();
        $line = Auth::user()->shop->id; 
        $shops = Auth::user()->shop()->get();
        //return $shops;  
        $categories = Shop::find($category)->categories()->get();
        //$categories;
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
        return view('product/add', compact('user', 'categories','lines','shops','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidate $request)
    {
      //return $request;
      $branches= Auth::user()->shop->branches;
        $exist = Product::where('clave', $request->clave)
        ->where('shop_id', Auth::user()->shop->id)
        ->first();
        if($exist){
              return redirect('/productos')->with('mesage', 'La Clave que intentas registrar ya existe!');
       }
      foreach($branches as $product){
        $total = $product->description;
        if($total == $request->description){
          return redirect('/products')->with('mesage', 'El nombre que intentas registrar ya existe!');
          }
        }
        
        $data = $request->all();
        $data['price'] = ($request->pricepz) ? $request->pricepz : $request->price;
        
        $category = Category::find($request->category_id);
        if($category->type_product == 1) {
          $data['line_id'] = null;
          $data['weigth'] = null;
        }

        $product = new Product($data);
      if ($request->hasFile('image')){
         $filename = $request->image->getCLientOriginalName();
         $request->image->storeAs('public/upload/products',$filename);
         $product->image = $filename;
      }
      $product->save();
      return redirect('/productos')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    return view('product.show', ['product' => Product::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $category = Auth::user()->shop->id;
        //return $category;
        $user = Auth::user();
        #$categories = Category::all();
        $line = Auth::user()->shop->id; 
        $shops = Auth::user()->shop()->get();
        //return $shops;  
        $categorys = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id; 
        $branches = Shop::find($branch)->branches()->get(); 
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
        $product = Product::find($id);
        //return $product;
        
      return view('product/edit', compact('product', 'categorys','lines','shops','branches','statuses','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')){

          // Borrar imagen anterior
          Storage::delete("public/upload/products/{$product->image}");

          $filename = $request->image->getCLientOriginalName();
          $timestamp = time();
          $request->image->storeAs('public/upload/products', $timestamp . $filename);
          $product->image = $timestamp . $filename;
      }
         $product->description = $request->description;
         $product->weigth = $request->weigth;
         $product->observations = $request->observations;  
         $product->price = $request->price;
          $product->inventory = $request->inventory;
         $product->save();

      //return $request->all();
      return redirect('/productos')->with('mesage-update', 'El producto se ha actualizado  exitosamente!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
        {
          Product::destroy($id);
        // return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');    
        }
/**TERMINA FUNCIONES DE CRUD DE PRODUCTOS */

/**FUNCIONES DE REPORTES DE PDF */
    public function exportPdf(){
        $product = Auth::user()->shop->id;
        $products = Shop::find($product)->products()->get();
        //return $products;
        $user = Auth::user(); 
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get(); 
        //return $shops;
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
        $line = Auth::user()->shop->id; 
        $lines = Shop::find($line)->lines()->get();
        //return $lines;  
        $status = Auth::user()->shop->id;
        $statuses = Shop::find($status)->statuss()->get();
      $pdf  = PDF::loadView('product.pdf', compact('user', 'categories','lines','shops','statuses','products'));
      return $pdf->download('Productos.pdf');
    }

    /**
     * Funcion para la vista del Reporte por Producto por Sucursal status
     * 
     ***/

     public function reportProduct(){
        $idshop = Auth::user()->shop->id;
         $user = Auth::user();
         $branch = Shop::find($idshop)->branches()->get();
         $status = Shop::find($idshop)->statuss()->get();
         $line = Shop::find($idshop)->lines()->get();
        $category = Auth::user()->shop->id;  
        $categories = Shop::find($category)->categories()->get();
         //return $categories;
    
      return view('product.Reports.reportproduct',compact('branch','user','status','line','categories'));
     }


     public function reportEstatus(Request $request){

/**Codigo para hacer las validaciones de los campos para realizar las consultas para el reporte */
      $idshop = Auth::user()->shop->id;
      $status = Shop::find($idshop)->statuss()->get();
      $line = Shop::find($idshop)->lines()->get();
      $category = Auth::user()->shop->id;  
      $categories = Shop::find($category)->categories()->get();

      $status = $request->estatus_id;
      $categories = $request->category_id;
      $line = $request->id;


      if($status == null || $categories == null || $line == null){
      return redirect('/reportes-productos')->with('mesage-update', 'Seleccina alguna opcion de cada selector!');      }

/**Termina codigo de validacion de campos */

/**Codigo de las consultas de acuerdo a los campos que fueron seleccionados en los combos */

      $branches = Branch::where("id","=",$request->branch_id)->get();
      $products = Product::where("branch_id","=",$request->branch_id)
                          ->where("status_id","=",$request->estatus_id)
                          ->where("category_id","=",$request->category_id)
                          ->where("line_id","=",$request->id)
                          ->get();
      
/**Finaliza codigo de las consultas por campos seleccionados */

/**Consultas para obtener el folio de la venta, la hora y el dia Uso de Carbon para las fechas y hora*/
      $sales = Sale::where("id","=","sale_id")->get();

      $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now(); 
      $dates = $dates->format('d-m-Y');
      
      $total = 0;
      foreach($products as $product){
      $total = $product->weigth + $total;
      }

      $cash = 0;
        foreach($products as $product){
          $cash = $product->price + $cash;
        }

        $lines = Line::where("id","=",$request->id)->get();

        $precio = 0;
        foreach($lines as $line){
          $precio = $line->purchase_price;
        }
        
        $compra = $total * $precio;
        $utilidad = $cash - $compra;

/**Finalizan consultas de folio de la venta, la hora y el dia */

/**Variable para retornar los archivos que podran ser descargados en pdf
 * contiene las variables de las cuales se hicieron las consultas para poder 
 * hacer uso de la informacion de cada consulta
 */

      $pdf  = PDF::loadView('product.Reports.reportEstatus', compact('products','branches','sales','hour','dates','total','cash','compra','utilidad'));
      return $pdf->download('ReporteEstatus.pdf');

/**Termina el retorno del pdf */
      
     }

     public function reportLineaG(Request $request){
      $branches = Branch::where("id","=",$request->branch_id)->get();
      $lines = Line::where("id","=",$request->id)->get();
      //return $lines;
      $products = Product::where("branch_id","=",$request->branch_id)
                          ->where("line_id","=",$request->id)
                          ->get();
        $total = 0;
        foreach($products as $product){
        $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach($products as $product){
          $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach($lines as $line){
          $precio = $line->purchase_price;
        }
        
        $compra = $total * $precio;
        $utilidad = $cash - $compra;


      $pdf  = PDF::loadView('product.Reports.reportLineaG', compact('products','branches','lines','total','cash','compra','utilidad'));
      return $pdf->download('ReporteLineas.pdf');
    } 

    public function reportEntradas(Request $request){

      $fech1 = Carbon::parse($request->fecini);
      $fech2 = Carbon::parse($request->fecter);

      /**
       * Checar este if para la validacion de la fecha de un rango de 1 a 1
       */
      if($fech1 === $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
                          ->where("line_id","=",$request->id)
                          ->where('created_at','=',$fech1)
                          ->get();
                          $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('products','branches','lines'));
                          return $pdf->download('ReporteEntradas.pdf');
                                
      }

      if($fech1 != $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
                            ->where("line_id","=",$request->id)
                            ->whereBetween('created_at', [$fech1 , $fech2])
                            ->get();
                            $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('products','branches','lines'));
                            return $pdf->download('ReporteEntradas.pdf');
                       
      }                       
    }

    public function reportLineaGGeneral(){
      $branches= Auth::user()->shop->branches;   
      $product = Auth::user()->shop->id;
      $products = Shop::find($product)->products()->get();
      $line = Auth::user()->shop->id; 
      $lines = Shop::find($line)->lines()->get();

      $total = 0;
        foreach($products as $product){
        $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach($products as $product){
          $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach($lines as $line){
          $precio = $line->purchase_price;
        }
        
  
    $pdf  = PDF::loadView('product.Reports.reportLineaGGeneral', compact('branches','lines','products','total','cash','precio'));
    return $pdf->download('ReporteLineasGeneral.pdf');
  }

  public function reportEstatusG(){

    $branches= Auth::user()->shop->branches;   
    $product = Auth::user()->shop->id;
    $products = Shop::find($product)->products()->get();
    $line = Auth::user()->shop->id; 
    $lines = Shop::find($line)->lines()->get();


    $sales = Sale::where("id","=","sale_id")->get();

      $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now(); 
      $dates = $dates->format('d-m-Y');

    $total = 0;
      foreach($products as $product){
      $total = $product->weigth + $total;
      }

      $cash = 0;
      foreach($products as $product){
        $cash = $product->price + $cash;
      }

      $precio = 0;
      foreach($lines as $line){
        $precio = $line->purchase_price;
      }

      $compra = $total * $precio;
      $utilidad = $cash - $compra;
      

  $pdf  = PDF::loadView('product.Reports.reportEstatusG', compact('branches','lines','products','total','cash','precio','hour','dates','sales','compra','utilidad'));
  return $pdf->download('ReporteEstatusGeneral.pdf');
  }
  
  public function reportEntradasG(){

    $branches= Auth::user()->shop->branches;   
    $product = Auth::user()->shop->id;
    $products = Shop::find($product)->products()->get();
    //return $products;
    $idshop = Auth::user()->shop->id;
    $status = Shop::find($idshop)->statuss()->get();
      
    //return $status;
    $line = Auth::user()->shop->id; 
    $lines = Shop::find($line)->lines()->get();

    /* $branches= Auth::user()->shop->branches;   
    $product = Auth::user()->shop->id;

    $name = 0;
    foreach($status as $sta){
      $sta->name =$name;
    }
    return $name;
    

    $products = Shop::find($product)->products()
                          ->where($sta->name,"!=",'Vendido')
                          ->get();
                          return $products;
      */

      $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now(); 
      $dates = $dates->format('d-m-Y');

    $total = 0;
      foreach($products as $product){
      $total = $product->weigth + $total;
      }

      $cash = 0;
      foreach($products as $product){
        $cash = $product->price + $cash;
      }

      $precio = 0;
      foreach($lines as $line){
        $precio = $line->purchase_price;
      }

      $compra = $total * $precio;
      $utilidad = $cash - $compra;
      

  $pdf  = PDF::loadView('product.Reports.reportEntradasG', compact('branches','lines','products','total','cash','precio','hour','dates','sales','compra','utilidad'));
  return $pdf->download('ReportereportEntradasGeneral.pdf');
  }
}