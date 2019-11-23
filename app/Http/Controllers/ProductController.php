<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

  use S3ImageManager;

	public function __construct(){

	}
	/** FUNCIONES PARA CRUD DE PRODUCTO */
	public function index()
	{
    	$user = Auth::user();
    	$shop_id = $user->shop->id;
    	if($user->type_user == User::CO) {
    		$products = Product::where([
          'branch_id' => $user->branch_id,
          'status_id' => 2
          ])->get();
    	} else {
      	$branches = Branch::where('shop_id', $user->shop->id)->get();
      	$branch_ids = $branches->map(function($item) {
      	  return $item->id;
        });
        $products = Shop::find($shop_id)
          ->products()
          ->whereIn('branch_id', $branch_ids)
          ->where('status_id', 2)
          ->get();
        }

		$adapter = Storage::disk('s3')->getDriver()->getAdapter();
    foreach ($products as $product) {
			if($product->image) {
        $path = 'products/' . $product->clave;
      } else {
        $path = 'dummy';
      }

      $command = $adapter->getClient()->getCommand('GetObject', [
        'Bucket' => $adapter->getBucket(),
        'Key' => $adapter->getPathPrefix(). $path
      ]);

      $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

      $product->image = (string) $result->getUri();
		}

    	$shops = Auth::user()->shop()->get();
    	//return $shops;
    	$category = Auth::user()->shop->id;
    	$categories = Shop::find($category)->categories()->get();
    	$line = Auth::user()->shop->id;
    	$lines = Shop::find($line)->lines()->get();
    	//return $lines;
    	$status = Auth::user()->shop->id;
    	$statuses = Status::all();
		  //  return $products;
    	return view('product/index', compact('user','categories','lines','shops','statuses','products'));
  }

  /** Función para listar los productos de  sucursal /productoCO */
    public function indexCOP()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->get();
        } else {
          $products = Shop::find($shop_id)->products()->get();
        }
        $shops = Auth::user()->shop()->get();
        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        $statuses = Shop::all();
        
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();
        foreach ($products as $product) {
          if($product->image) {
            $path = 'products/' . $product->clave;
          } else {
            $path = 'dummy';
          }
    
          $command = $adapter->getClient()->getCommand('GetObject', [
            'Bucket' => $adapter->getBucket(),
            'Key' => $adapter->getPathPrefix(). $path
          ]);
    
          $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');
    
          $product->image = (string) $result->getUri();
        }
        return view('product/index', compact('user', 'categories','lines','shops','statuses','products'));
    }
/** Listar todos los  Porductos de la tienda  para los colaboradores /productosCO */
    public function indexCO()  
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        $shops = Auth::user()->shop()->get();
        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        //$statuses = Shop::find($shop_id)->statuss()->get();
        $statuses = Status::all();
        $products = Shop::find($shop_id)->products()->get();
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($products as $product) {
          if($product->image) {
            $command = $adapter->getClient()->getCommand('GetObject', [
              'Bucket' => $adapter->getBucket(),
              'Key' => $adapter->getPathPrefix(). 'products/' . $product->clave
            ]);

            $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

            $product->image = (string) $result->getUri();
         //return $products;
        return view('product/productCO/index', compact('user', 'categories','lines','shops','statuses','products'));
    }
  }
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
    	  $statuses = Status::all();
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
      // return $request;
      $date= date("Y-m-d");
      $branches= Auth::user()->shop->branches;
      $user = Auth::user();
      $branches= $user->shop->branches;
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
        $data['price'] = ($request->pricepzt) ? $request->pricepzt : $request->price;
        $data['discount'] = $request->max_discount ? $request->max_discount : 0;
        $data['user_id'] = Auth::user()->id;
        $data['price_purchase'] = $request->price_purchase;
        $data['status_id'] = 2;

        $category = Category::find($request->category_id);
        if($category->type_product == 1) {
          $data['line_id'] = null;
          $data['weigth'] = null;

        }

        $product = new Product($data);
        $product->date_creation= $date;
      // if ($request->hasFile('image')){
      //    $filename = $request->image->getCLientOriginalName();
      //    $request->image->storeAs('public/upload/products',$filename);
      //    $product->image = $filename;
      // }

		if($request->hasFile('image')) {
			$adapter = Storage::disk('s3')->getDriver()->getAdapter();
			$image = file_get_contents($request->file('image')->path());
			$base64Image = base64_encode($image);
			$path = 'products';
			$product->image = $this->saveImages($base64Image, $path, $product->clave);
		}
      $product->save();
      return redirect('/productos')->with('mesage', 'El Producto  se ha agregado exitosamente!');
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
        $user = Auth::user();
        #$categories = Category::all();
        $line = Auth::user()->shop->id;
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $categories = Shop::find($category)->categories()->get();
        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id;
        $branches = Shop::find($branch)->branches()->get();
        //$status = Auth::user()->shop->id;
        //$statuses = Shop::find($status)->statuss()->get();
				$statuses = Status::all();
        $product = Product::find($id);
        // return $product; 

      return view('product/edit', compact('product', 'categories','lines','shops','branches','statuses','user'));
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

        if($request->hasFile('image')) {
          $adapter = Storage::disk('s3')->getDriver()->getAdapter();
          $image = file_get_contents($request->file('image')->path());
          $base64Image = base64_encode($image);
          $path = 'products';
          $product->image = $this->saveImages($base64Image, $path, $product->clave);
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
        $shop_id = Auth::user()->shop->id;
        $products = Shop::find($shop_id)->products()->get();
        //return $products;
        $user = Auth::user();
        //$categories = Category::all();
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        //return $lines;
        //$status = Auth::user()->shop->id;
        $statuses = Status::all();
        $pdf  = PDF::loadView('product.pdf', compact('user', 'categories','lines','shops','statuses','products'));
      return $pdf->stream('Productos.pdf');
    }
    /**
     * Funcion para la vista del Reporte por Producto por Sucursal status
     *
     ***/
     public function reportProduct(){
        $idshop = Auth::user()->shop->id;
         $user = Auth::user();
         $branch = Shop::find($idshop)->branches()->get();
    	  $statuses = Status::all();
         $line = Shop::find($idshop)->lines()->get();
        $category = Auth::user()->shop->id;
        $categories = Shop::find($category)->categories()->get();
         //return $categories;

      return view('product.Reports.reportproduct',compact('branch','user','statuses','line','categories'));
     }


     public function reportEstatus(Request $request){

/**Codigo para hacer las validaciones de los campos para realizar las consultas para el reporte */
      $idshop = Auth::user()->shop->id;
      //$status = Shop::find($idshop)->statuss()->get();
    	$status = Status::all();
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
          $discount = $line->discount;
        }

        $compra = $total * $precio;
        $utilidad = $cash - $compra;
      
/**Finalizan consultas de folio de la venta, la hora y el dia */

/**Variable para retornar los archivos que podran ser descargados en pdf
 * contiene las variables de las cuales se hicieron las consultas para poder
 * hacer uso de la informacion de cada consulta
 */

      $pdf  = PDF::loadView('product.Reports.reportEstatus', compact('products','branches','sales','hour','dates','total','cash','compra','utilidad'));
      return $pdf->stream('ReporteEstatus.pdf');
      }
/**Termina el retorno del pdf */
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
      return $pdf->stream('ReporteLineas.pdf');
    }
//**Reporte de Entradas De Prosuctos Por Fechas */
    public function reportEntradas(Request $request){
//return $request;
      $fech1 = Carbon::parse($request->fecini)->format('Y-m-d');
      $fech2 = Carbon::parse($request->fecter)->format('Y-m-d');
      /**
       * Checar este if para la validacion de la fecha de un rango de 1 a 1
       */
      if($fech1 == $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        //$categories = Category::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
                          ->where("line_id","=",$request->id)
                          ->where('date_creation','=',$fech1)
                          ->where('date_creation','=',$fech2)
                          ->get();
                          //return $products;
                          $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('products','branches','lines'));
                          return $pdf->download('ReporteEntradas.pdf');

      }elseif($fech1 != $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        //$categories = Category::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
                            ->where("line_id","=",$request->id)
                            ->whereBetween('date_creation',[$fech1,$fech2])
                            ->get();
                    //return $products;

                            $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('products','branches','lines'));
                            return $pdf->download('ReporteEntradas.pdf');

      }/**elseif($fech1 == $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
                            ->where("line_id","=",$request->id)
                            ->whereBetween('created_at', [$fech1 , $fech2])
                            ->get();
                    return $products;

      }*/
    }

    public function reportLineaGGeneral(){
      $branches= Auth::user()->shop->branches;
      $product = Auth::user()->shop->id;
      $products = Shop::find($product)->products()->get();
      $line = Auth::user()->shop->id;
      $lines = Shop::find($line)->lines()->get();
      $category = Auth::user()->shop->categories;
      $products = Shop::find($product)->products()->where('status_id',2)->get();
      //return $products;
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
    return $pdf->stream('ReporteLineasGeneral.pdf');
  }

  public function reportEstatusG(){
##en desarrollo
    $branches= Auth::user()->shop->branches;
    $id_shop = Auth::user()->shop->id;
    $products = Shop::find($id_shop)->products()->get();
    $lines = Shop::find($id_shop)->lines()->get();
    //return $lines;
    $categories = Shop::find($id_shop)->categories()->get();
    //return $categories;
   $productsg = Shop::join('products','products.shop_id','shops.id')
   ->join('categories','categories.id','products.category_id')
   ->join('lines','lines.id','products.line_id')
   ->join('statuss','statuss.id','products.status_id')
   ->select('products.*', 'categories.name as name_category', 'lines.name as name_line','categories.type_product','statuss.name as name_status')
    ->where('categories.type_product',2)
    ->where('statuss.id',2)->get();
  //$products = Shop::find($id_shop)->products()->category()->get();
  return $products;
  /**$products = DB::table('categories')
            ->join('products', 'categories.id','products.category_id')
            ->join('products as product','type_product','type_product')
            ->orderby('products.id')
            ->get();**/
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


  $pdf  = PDF::loadView('product.Reports.reportEstatusG', compact('branches','categories','id_shop','lines','products','total','cash','precio','hour','dates','compra','utilidad'));
  return $pdf->stream('ReporteEstatusGeneral.pdf');
  }

  //** función que genera el reporte  general de productos por gramos-entradas */
  public function reportEntradasG_pgr(Request $request){
    $branches= Auth::user()->shop->branches;
    $shop_id = Auth::user()->shop->id;
    #pasar fecha actual
    $category_type_product = category::find($shop_id)->get();
   //return $category_type_product;
    $products = Shop::join('products','products.shop_id','shops.id')
   ->join('categories','categories.id','products.category_id')
   ->join('lines','lines.id','products.line_id')
   ->join('statuss','statuss.id','products.status_id')
   ->select('products.*', 'categories.name as name_category', 'lines.name as name_line','categories.type_product','statuss.name as name_status')
    ->where('categories.type_product',2)
    ->where('statuss.id',2)->get();
  //return $products;
    $status = Shop::find($shop_id)->statuss()->get();
    //return $status;
    $lines = Shop::find($shop_id)->lines()->get();
    foreach($lines as $line){
      $line->total_g = $products->where('line_id', $line->id)->sum('weigth');
    }

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

      //return $products;

  $pdf  = PDF::loadView('product.Reports.reportEntradasG_pgr', compact('branches','lines','products','total','cash','precio','hour','dates','compra','utilidad'));
  return $pdf->stream('R.EntradasGeneral_pgr.pdf');
  }

  //** función que genera el reporte  general de productos por pieza-entradas **//
  public function reportEntradasP_pz(Request $request){
     $branches= Auth::user()->shop->branches;
    $shop_id = Auth::user()->shop->id;
    #pasar fecha actual
    //$category_type_product = category::find($shop_id)->get();
   //return $category_type_product;
    $status = Shop::find($shop_id)->statuss()->get();
    $categories = Shop::find($shop_id)->categories()->get();
    $products = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->select('products.*', 'categories.name as name_category','categories.type_product','statuss.name as name_status')
    ->where('categories.type_product',1)
    ->where('statuss.id',2)->get();
     //return $products;
    $hour = Carbon::now();
    $hour = date('H:i:s');
    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');
    foreach($products as $product){

      $categorie->total_price_purchase = $categories->where('name', $product->name_category)->sum('pricepzt');
    }
    return $categorie->total_price_purchase;

      /**foreach($products as $product){
      $product->total_price_purchase = $product->price_purchase + $total;
      }**/
      //return $total_price_purchase;

      $total_sale_price = 0;
      foreach($products as $product){
        $total_sale_price = $product->pricepzt;
      }



      //$compra = $total * $precio;
      //$utilidad = $cash - $compra;

      //return $total_sale_price;

  $pdf  = PDF::loadView('product.Reports.reportEntradasGppz', compact('branches','categories','products','total','total_sale_price','hour','dates'));
  return $pdf->stream('R.EntradasGeneral_ppz.pdf');
  }

/**Reporte para sacar la utilida de productos por pzs */
  public function reportProductpzs(Request $request){
    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');
    $hour = Carbon::now();
    $hour = date('H:i:s');
    $productos = Auth::user()->shop->id;
    $category = 1;
    $productos = Product::where('category_id',$category)->get();
    $sumprice = Product::where('category_id',$category)->sum('products.pricepzt');
    $sumprice_purchase = Product::where('category_id',$category)->sum('products.price_purchase');
    $adescuento = $request->descuento;
    $descuento = $sumprice * $request->descuento / 100;
    $total = $sumprice - $descuento;
       //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);

      $pdf  = PDF::loadView('product.Reports.reportProductpzs', compact('productos','sumprice','sumprice_purchase','descuento','total','dates','hour','adescuento'));
      return $pdf->stream('ReporteProductospzs.pdf');

   //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);
  }

}
