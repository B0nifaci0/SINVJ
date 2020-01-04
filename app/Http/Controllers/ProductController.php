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
use App\ShopGroup;
use Carbon\Carbon;
use App\SaleDetails; 
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
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
          ])->orderBy('clave','asc')->get();
    	} else {
      	$branches = Branch::where('shop_id', $user->shop->id)->get();
      	$branch_ids = $branches->map(function($item) {
      	  return $item->id;
        });
        $products = Shop::find($shop_id)
          ->products()
          ->with('line')
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

      $product->image = $this->getS3URL($path);
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
     // $title = 'Productos De Tienda';      
		  //  return $products;
    	return view('product/index', compact('user','categories','lines','shops','statuses','products'));
  }

  public function reportProductSeparated() {
    $user = Auth::user();
    $shop_id = $user->shop->id;

    if($user->type_user == User::CO) {
      $products = Product::where([
        'products.branch_id' => $user->branch_id,
        'status_id' => 1
        ])
        ->where('sales.paid_out', '>=', 'total')
        ->select(
          'id',
          'clave',
          'description',
          'weigth',
          'observations',
          'price',
          'price_purchase',
          'discount',
          'discar_cause',
          'image',
          'category_id',
          'line_id',
          'shop_id',
          'products.branch_id',
          'date_creation',
          'products.user_id',
          'sold_at',
          'discarded_at',
          'status_id'
        )
        ->get();
    } else {
      $branches = Branch::where('shop_id', $user->shop->id)->get();
      $branch_ids = $branches->map(function($item) {
        return $item->id;
      });
      $products = Shop::find($shop_id)
        ->products()
        ->join('sale_details', 'sale_details.product_id', 'products.id')
        ->join('sales', 'sales.id', 'sale_details.sale_id')
        ->where('sales.paid_out', '>=', 'total')
        ->whereIn('products.branch_id', $branch_ids)
        ->where('status_id', 1)
        ->select(
          'products.id',
          'clave',
          'description',
          'weigth',
          'observations',
          'price',
          'price_purchase',
          'discount',
          'discar_cause',
          'image',
          'category_id',
          'line_id',
          'shop_id',
          'products.branch_id',
          'date_creation',
          'products.user_id',
          'sold_at',
          'discarded_at',
          'status_id'
        )
        ->get();
      }
      $adapter = Storage::disk('s3')->getDriver()->getAdapter();

      foreach ($products as $product) {
        if($product->image) {
          $path = 'products/' . $product->clave;
        } else {
          $path = 'dummy';
        }
        $product->image = $product->image = $this->getS3URL($path);
      }
      $title = 'Productos apartados';
    	return view('product/index', compact('products', 'title'));
  }

  /** Función para listar los productos de  sucursal /productoCO */
    public function indexCOP()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if($user->type_user == User::CO) {
          $products = Product::where('branch_id', $user->branch_id)->orderBy('description','asc')->get();
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
        foreach($shops as $shop){
          $grupo = $shop->shop_group_id;
        }

        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        //$statuses = Shop::find($shop_id)->statuss()->get();
        $statuses = Status::all();
        
        //$shop_group_id ==
        if($grupo==null){
          $products = Shop::find($shop_id)->products()->get();
        }else{
          //$products = ShopGroup::shop()->get();
          $products = Product::join('shops', 'shops.id','=', 'products.shop_id')->where('shops.shop_group_id',$grupo)->get();

        }
        //return $products;
        
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($products as $product) {
          if($product->image) {
            $command = $adapter->getClient()->getCommand('GetObject', [
              'Bucket' => $adapter->getBucket(),
              'Key' => $adapter->getPathPrefix(). 'products/' . $product->clave
            ]);

            $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

            $product->image = (string) $result->getUri(); 
      }
    }
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
      //return $request;
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
          $data['discount'] = $request->max_discountpz ? $request->max_discountpz : 0;

        }

        $categories = Auth::user()->shop->categories()->get();
        $client_category_id = $request->category_id;

        $selected_category = $categories->filter(function ($value, $key) use ($client_category_id) {
            return $value->id == $client_category_id;
        })->first();

        $categories = $categories->reject(function ($value, $key) use ($client_category_id) {
            return $value->id == $client_category_id;
        });
        $categories->prepend($selected_category);
        
        /**if($category->type_product == 1 && (!$data['pricepzt']) || !is_numeric($data['pricepzt'])){
          return back()->with('categories', $categories)->withErrors(['msg', 'El precio por pieza es requerido y debe ser numerico']);
        }
        elseif($category->type_product == 2 && (!$data['weigth']) || !is_numeric($data['weigth'])){
            return back()->with('categories', $categories)->withErrors(['msg', 'El peso es requerido y debe ser numerico']);
        }*/

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
      $product->image = $this->saveImages($base64Image, $path, $product->clave);;
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
        $line = Auth::user()->shop->id;
        $shops = Auth::user()->shop()->get();
        //return $shops;
        $product = Product::find($id);
        
        $shop_categories = Category::where('shop_id', $category)->where('id', '!=', $product->category_id)->get();
        $categories = Category::where('id', $product->category_id)->get();

        $categories = $categories->merge($shop_categories);

        $lines = Shop::find($line)->lines()->get();
        $branch = Auth::user()->shop->id;
        $branches = Shop::find($branch)->branches()->get();
				$statuses = Status::all();
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
    public function update(ProductValidate $request, $id)
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
        //$product->inventory = $request->inventory;
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
        $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();
    $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');


    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
        $pdf  = PDF::loadView('product.pdf', compact('shop','shops','dates','hour','user', 'categories','lines','shops','statuses','products'));
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
        $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();
    $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');


    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
         //return $categories;

      return view('product.Reports.reportproduct',compact('hour','dates','shop','shops','branch','user','statuses','line','categories'));
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

      $trans = TransferProduct::all();

/**Termina codigo de validacion de campos */

$fecini = Carbon::parse($request->fecini)->format('Y-m-d');
$fecter = Carbon::parse($request->fecter)->format('Y-m-d');

/**Codigo de las consultas de acuerdo a los campos que fueron seleccionados en los combos */

      $branches = Branch::where("id","=",$request->branch_id)->get();
      $products = Product::where("branch_id","=",$request->branch_id)
      ->whereBetween('products.updated_at',[$fecini,$fecter])
      ->where("status_id","=",$request->estatus_id)
      ->where("category_id","=",$request->category_id)
      ->where("line_id","=",$request->id)
      ->orderBy('clave','asc')
      ->get();

      $detalle = SaleDetails::all();

      $estado = Status::findOrFail($request->estatus_id);

/**Finaliza codigo de las consultas por campos seleccionados */

/**Consultas para obtener el folio de la venta, la hora y el dia Uso de Carbon para las fechas y hora*/
      $sales = Sale::where("id","=","sale_id")->get();
     // $detalles = SaleDetail::where("sale_id",$sales->id);
      $hour = Carbon::now();
      $hour = date('H:i:s');

      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');

      $total = 0;
      foreach($products as $product){
      $total = $product->weigth + $total;
      }

      $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }

      $cash = 0;
        foreach($products as $product){
          $cash = $product->price + $cash;
        }

        $lines = Line::where("id","=",$request->id)->get();

        $precio = 0;
        $venta = 0;
        foreach($products as $product){
          $precio = $product->price_purchase + $precio; 
          foreach ($detalle as $det)
          if($det->product_id == $product->id){
            $venta = $venta + $det->final_price;
          }
        }
        $compra = $precio;

        $utilidad = $compra - $venta;
      
/**Finalizan consultas de folio de la venta, la hora y el dia */

/**Variable para retornar los archivos que podran ser descargados en pdf
 * contiene las variables de las cuales se hicieron las consultas para poder
 * hacer uso de la informacion de cada consulta
 */

      $pdf  = PDF::loadView('product.Reports.reportEstatus', compact('shop','shops','estado','products','branches','sales','hour','dates','total','cash','compra','utilidad','trans','detalle','venta'));
      return $pdf->stream('ReporteEstatus.pdf');
      }
/**Termina el retorno del pdf */
     public function reportLinea(Request $request){
      $branches = Branch::where("id","=",$request->branch_id)->get();
      $lines = Line::where("id","=",$request->id)->get();
      $products = Product::where("branch_id","=",$request->branch_id)
                          ->where("line_id","=",$request->id)
                          ->orderBy('clave','asc')
                          ->get();
     // return $products;
      $hour = Carbon::now();
      $hour = date('H:i:s');
                    
      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');

      $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }

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


      $pdf  = PDF::loadView('product.Reports.reportLinea', compact('shop','shops','products','branches','lines','total','cash','compra','utilidad','dates','hour'));
      return $pdf->stream('ReporteLineas.pdf');
    }


//**Reporte de Entradas De Prosuctos Por Fechas */
    public function reportEntradas(Request $request){
//return $request;

      $hour = Carbon::now();
      $hour = date('H:i:s');
      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');
      $fech1 = Carbon::parse($request->fecini)->format('Y-m-d');
      $fech2 = Carbon::parse($request->fecter)->format('Y-m-d');

      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');

      $hour = Carbon::now();
      $hour = date('H:i:s');

      /**
       * Checar este if para la validacion de la fecha de un rango de 1 a 1
       */
      if($fech1 == $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        //$categories = Category::where("id","=",$request->id)->get();
        $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
      $shop->image = $this->getS3URL($shop->image);
    }
      $products = Product::where("branch_id","=",$request->branch_id)
      ->where("line_id","=",$request->id)
      ->where('date_creation','=',$fech1)
      ->where('date_creation','=',$fech2)
      ->orderBy('clave','asc')
      ->get();
      //return $products;
      $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('shop','shops','products','branches','lines','hour','dates'));
      return $pdf->stream('ReporteEntradas.pdf');

      }elseif($fech1 != $fech2){
        $branches = Branch::where("id","=",$request->branch_id)->get();
        $lines = Line::where("id","=",$request->id)->get();
        //$categories = Category::where("id","=",$request->id)->get();
        $products = Product::where("branch_id","=",$request->branch_id)
        ->where("line_id","=",$request->id)
        ->whereBetween('date_creation',[$fech1,$fech2])
        ->orderBy('clave','asc')
        ->get();
        //return $products;
        $shop = Auth::user()->shop; 
        $shops = Auth::user()->shop()->get();       
        if($shop->image) {
          $shop->image = $this->getS3URL($shop->image);
        }
                    
      $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('shop','shops','products','branches','lines','hour','dates'));
      return $pdf->stream('ReporteEntradas.pdf');

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
//**  */
    public function reportLineaG(){
      $branches= Auth::user()->shop->branches;
      $product = Auth::user()->shop->id;
      $products = Shop::find($product)->products()->get();
      $line = Auth::user()->shop->id;
      $lines = Shop::find($line)->lines()->get();
      // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
      $categories = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->select('categories.name','categories.type_product')
      ->distinct('categories.name')
      ->where('categories.type_product',1)
      ->get();
       // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR GRAMO
      $products = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('branches','branches.id','products.branch_id')
      ->join('lines','lines.id','products.line_id')
      ->select('products.*', 'lines.name as name_line', 'branches.name as name_branch', 'categories.name as name_category','categories.type_product','statuss.name as name_status')
      ->where('categories.type_product',2)
      ->orderBy('products.clave', 'ASC')
      ->orderBy('name_branch', 'ASC')
      ->orderBy('name_line', 'ASC')
      ->get();
      //return $products;
      $shop = Auth::user()->shop; 
      $hour = Carbon::now();
      $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
      $shops = Auth::user()->shop()->get();

      if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
      }

      $totals = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->join('lines','lines.id','products.line_id')
      ->where('statuss.id',2)
      ->where('lines.shop_id', Auth::user()->shop->id)  
      ->where('categories.type_product',2)  
      ->select('lines.id', 'lines.name', DB::raw('SUM(products.weigth) as total_w, SUM(products.price) as total_p'))
      ->distinct('lines.name')
      ->groupBy('lines.id', 'lines.name')
      ->get();

      $pdf  = PDF::loadView('product.Reports.reportLineaGeneral', compact('shop','hour','dates','shops','branches','lines','products','totals'));
      return $pdf->stream('ReporteLineasGeneral.pdf');
  }

  //**  */
  public function reportCategoriaGeneral(){

    $hour = Carbon::now();
    $hour = date('H:i:s');

    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');

    $branches= Auth::user()->shop->branches;
    $product = Auth::user()->shop->id;

    $line = Auth::user()->shop->id;
    $lines = Shop::find($line)->lines()->get();
    // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
    $categories = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->select('categories.name','categories.type_product')
    ->distinct('categories.name')
    ->where('categories.type_product',1)
    ->get();
    // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR PIEZAS
    $products = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->join('branches','branches.id','products.branch_id')
    ->select('products.*', 'branches.name as name_branch', 'categories.name as name_category','categories.type_product','statuss.name as name_status')
    ->where('categories.type_product',1)
    ->orderBy('products.clave', 'ASC')
    ->orderBy('name_branch', 'ASC')
    ->get();
    //return $products;
    $shop = Auth::user()->shop; 
    $hour = Carbon::now();
    $hour = date('H:i:s');
      $dates = Carbon::now();
      $dates = $dates->format('d-m-Y');
  $shops = Auth::user()->shop()->get();

  if($shop->image) {
      $shop->image = $this->getS3URL($shop->image);
  }

  $cash = Category::join('products', 'products.category_id', 'categories.id')
    ->where('categories.shop_id', Auth::user()->shop->id)  
    ->where('categories.type_product',1)  
    ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
    ->distinct('categories.name')
    ->groupBy('categories.id', 'categories.name')
    ->get();
  

  $pdf  = PDF::loadView('product.Reports.reportCategoriaGeneral', compact('categories','shop','hour','dates','shops','branches','lines','products','cash'));
  return $pdf->stream('ReporteCategoriasPGeneral.pdf');
}

//** funcion para generar reporte general de todas las sucursales por productos gramos */
  public function reportEstatusG(Request $request){
##en desarrollo
    $branches= Auth::user()->shop->branches;
    $id_shop = Auth::user()->shop->id;
    $lines = Shop::find($id_shop)->lines()->get();
    //return $lines;
    $categories = Shop::find($id_shop)->categories()->get();
    //return $categories;
    $fecini = Carbon::parse($request->fecini)->format('Y-m-d');
    $fecter = Carbon::parse($request->fecter)->format('Y-m-d');
    $categoria = $request->cat;
    if($categoria == 2){
      $productsg = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('lines','lines.id','products.line_id')
      ->join('statuss','statuss.id','products.status_id')
      ->where('products.updated_at','>=',$fecini,'AND','products.updated_at','<=',$fecter)
      ->select('products.*','categories.name as name_category','lines.name as name_line','categories.type_product','statuss.name as name_status')
       ->where('categories.type_product',$request->cat)
       ->OrderBy('products.clave','asc')
       ->get();
    }else{
      $productsg = Shop::join('products','products.shop_id','shops.id')
      ->join('categories','categories.id','products.category_id')
      ->join('statuss','statuss.id','products.status_id')
      ->where('products.updated_at','>=',$fecini,'AND','products.updated_at','<=',$fecter)
      ->select('products.*','categories.name as name_category','categories.type_product','statuss.name as name_status')
       ->where('categories.type_product',$request->cat)
       ->OrderBy('products.clave','asc')
       ->get();
    }

    
    $hour = Carbon::now();
    $hour = date('H:i:s');

    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');

    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }

    $total = 0;
      foreach($productsg as $product){
      $total = $product->weigth + $total;
      }

      $cash = 0;
      foreach($productsg as $product){
        $cash = $product->price + $cash;
      }

      $precio = 0;
      foreach($lines as $line){
        $precio = $line->purchase_price;
      }

      $compra = $total * $precio;
      $utilidad = $cash - $compra;


  $pdf  = PDF::loadView('product.Reports.reportEstatusG', compact('shop','shops','branches','categories','id_shop','lines','productsg','total','cash','precio','hour','dates','compra','utilidad','categoria','categoria'));
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
   // $status = Shop::find($shop_id)->statuss()->get();
    //return $status;
    $lines = Shop::find($shop_id)->lines()->get();
    foreach($lines as $line){
      $line->total_g = $products->where('line_id', $line->id)->sum('weigth');
    }
    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
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

  $pdf  = PDF::loadView('product.Reports.reportEntradasG_pgr', compact('shop','shops','branches','lines','products','total','cash','precio','hour','dates','compra','utilidad'));
  return $pdf->stream('R.EntradasGeneral_pgr.pdf');
  }

  //** función que genera el reporte  general de productos por gramos */
  public function reportEntradasPr_gpgr(Request $request){
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
    ->where('categories.type_product',2)->get();
  //return $products;
   // $status = Shop::find($shop_id)->statuss()->get();
    //return $status;
    $lines = Shop::find($shop_id)->lines()->get();
    //FUNCION PARA CALCULAR EL TOTAL DE GRAMOS POR LINEA
    foreach($lines as $line){
      $line->total_g = $products->where('line_id', $line->id)->sum('weigth');
    }
    //return $line->total_g;

    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
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

  $pdf  = PDF::loadView('product.Reports.reportEntradasPr_gpgr', compact('shop','shops','branches','lines','products','total','shop','shops','cash','precio','hour','dates','compra','utilidad'));
  return $pdf->stream('R.EntradasGeneral_ppgr.pdf');
  }

  //** función que genera el reporte  general de productos por piezas */
  public function reportEntradasPr_gppz(Request $request){
    $branches= Auth::user()->shop->branches;
    $shop_id = Auth::user()->shop->id;
    #pasar fecha actual
    // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
    $categories = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->select('categories.name','categories.type_product')
    ->distinct('categories.name')
    ->where('categories.type_product',1)
    ->get();
    // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR PIEZAS
    $products = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->join('branches','branches.id','products.branch_id')
    ->select('products.*', 'categories.name as name_category','categories.type_product','statuss.name as name_status','branches.name as name_branch')
    ->where('categories.type_product',1)
    ->get();
    $hour = Carbon::now();
    $hour = date('H:i:s');
    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');
    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
      // FUNCION PARA CALCULAR LA SUMA TOTAL POR CATEGORIAS
   $totals = Category::join('products', 'products.category_id', 'categories.id')
    ->where('categories.shop_id', Auth::user()->shop->id)  
    ->where('categories.type_product',1)  
    ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
    ->distinct('categories.name')
    ->groupBy('categories.id', 'categories.name')
    ->get();

  $pdf  = PDF::loadView('product.Reports.reportEntradasPr_gppz', compact('shop','shops','branches','categories','products','hour','dates', 'totals'));
  return $pdf->stream('R.EntradasGeneralPr_gppz.pdf');
  }

  //** función que genera el reporte  general de productos por pieza-entradas **//
  public function reportEntradasP_pz(Request $request){
     $branches= Auth::user()->shop->branches;
    $shop_id = Auth::user()->shop->id;
    $categories = Shop::find($shop_id)->categories()->get();
    $products = Shop::join('products','products.shop_id','shops.id')
    ->join('categories','categories.id','products.category_id')
    ->join('statuss','statuss.id','products.status_id')
    ->select('products.*', 'categories.name as name_category','categories.type_product','statuss.name as name_status')
    ->where('categories.type_product',1)
    ->where('statuss.id',2)->get();
    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
     //return $products;
    $hour = Carbon::now();
    $hour = date('H:i:s');
    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');

      foreach($categories as $categorie){
        $categorie->total_s = $products->where('category_id', $categorie->id)->sum('price');
      }
      //return $categorie->total_s;

      $total_sale_price = 0;
      foreach($products as $product){
        $total_sale_price = $product->pricepzt;
      }



      //$compra = $total * $precio;
      //$utilidad = $cash - $compra;

      //return $total_sale_price;

  $pdf  = PDF::loadView('product.Reports.reportEntradasGppz', compact('shop','shops','branches','categories','products','total_sale_price','hour','dates'));
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
    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

    if($shop->image) {
        $shop->image = $this->getS3URL($shop->image);
    }
       //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);

      $pdf  = PDF::loadView('product.Reports.reportProductpzs', compact('shop','shops','productos','sumprice','sumprice_purchase','descuento','total','dates','hour','adescuento'));
      return $pdf->stream('ReporteProductospzs.pdf');

   //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);
  }

  public function reportUtility(Request $request){

    /**Codigo para hacer las validaciones de los campos para realizar las consultas para el reporte */
    $idshop = Auth::user()->shop->id;
    //$status = Shop::find($idshop)->statuss()->get();
    $status = Status::all();
    $line = Shop::find($idshop)->lines()->get();
    $category = Auth::user()->shop->id;
    $categories = Shop::find($category)->categories()->get();

    $status = $request->estatus_id;
    $categoria = $request->category_id;
    $line = $request->id;
    
    /**Termina codigo de validacion de campos */
    
    $fecini = Carbon::parse($request->fecini)->format('Y-m-d');
    $fecter = Carbon::parse($request->fecter)->format('Y-m-d');
    
    /**Codigo de las consultas de acuerdo a los campos que fueron seleccionados en los combos */

    $branches = Branch::where("id","=",$request->branch_id)->get();
      $products = Product::where("branch_id","=",$request->branch_id)
      ->join('categories','categories.id','products.category_id')
      ->join('sale_details','sale_details.product_id','products.id')
      ->select('products.*','categories.type_product as tipo','sale_details.product_id as id_product','sale_details.final_price as final_price','sale_details.profit as profit')
      ->where('products.updated_at','>=',$fecini,'AND','products.updated_at','<=',$fecter)
      ->where('categories.type_product',$request->cat)
      ->where("status_id","=",1)
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

  $shop = Auth::user()->shop; 
  $shops = Auth::user()->shop()->get();

  if($shop->image) {
    $shop->image = $this->getS3URL($shop->image);
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
  
  $venta = 0;
  foreach($products as $product){
    $precio = $product->price_purchase + $precio; 
      $venta = $venta + $product->final_price;
  }

  $compra = $precio;
  $utilidad = $venta - $compra;

            
    /**Finalizan consultas de folio de la venta, la hora y el dia */
    
    /**Variable para retornar los archivos que podran ser descargados en pdf
     * contiene las variables de las cuales se hicieron las consultas para poder
     * hacer uso de la informacion de cada consulta
     */
    
  $pdf  = PDF::loadView('product.Reports.UtilityReport', compact('shop','shops','products','branches','sales','hour','dates','total','cash','compra','utilidad','lines','venta','categoria'));
  return $pdf->stream('ReporteUtilidad.pdf');

  }  

  public function reportPz(Request $request){
    $branches = Branch::where("id","=",$request->branch_id)->get();
    $categories = Category::where("id","=",$request->category_id)->get();
    //return $categories;
    $products = Product::where("branch_id","=",$request->branch_id)
                        ->where("category_id","=",$request->category_id)
                        ->orderBy('clave','asc')
                        ->get();
    //return $products;
    $hour = Carbon::now();
    $hour = date('H:i:s');
                  
    $dates = Carbon::now();
    $dates = $dates->format('d-m-Y');

    $shop = Auth::user()->shop; 
    $shops = Auth::user()->shop()->get();

  if($shop->image) {
      $shop->image = $this->getS3URL($shop->image);
  }
  $cash = Category::join('products', 'products.category_id', 'categories.id')
  ->where('categories.shop_id', Auth::user()->shop->id)  
  ->where('categories.type_product',$request->cat)
  ->where('categories.id',$request->category_id)
  ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
  
  ->groupBy('categories.id', 'categories.name')
  ->get();

    $pdf  = PDF::loadView('product.Reports.reportCategoria', compact('shop','shops','products','branches','dates','hour','cash'));
    return $pdf->stream('ReporteLineas.pdf');
  }

}
