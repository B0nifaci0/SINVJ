<?php

namespace App\Http\Controllers;

use PDF;
use App\Line;
use App\Shop;
use App\User;
use App\Branch;
use App\Status;
use App\Product;
use App\Expense;
use App\Category;
use Carbon\Carbon;
use App\SaleDetails;
use App\TransferProduct;
use Illuminate\Http\Request;
use App\Traits\S3ImageManager;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// use Yajra\Datatables\Datatables;

class ProductController extends Controller
{

    use S3ImageManager;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }


    /** FUNCIONES PARA CRUD DE PRODUCTO */
    public function index()
    {
        $user = $this->user;
        return view('product.index', compact('user'));
    }

    public function serverSide()
    {
        $user = $this->user;

        if ($user->isAdmin())
            $products = $user->shop->products();
        else
            $products = $user->branch->products();

        $products = $products
            ->with('category:id,name')
            ->with('line:id,name')
            ->with('branch:id,name')
            ->with('status:id,name')
            ->get();
        return datatables()->of($products)->toJson();
    }

    public function reportProductSeparated()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;

        if ($user->type_user == User::CO) {
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
            $branch_ids = $branches->map(function ($item) {
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
        $title = 'Productos apartados';

        foreach ($products as $product) {
            if ($product->image) {
                $path = 'products/' . $product->clave;
            } else {
                $branches = Branch::where('shop_id', $user->shop->id)->get();
                $branch_ids = $branches->map(function ($item) {
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
            $title = 'Productos apartados';

            foreach ($products as $product) {
                if ($product->image) {
                    $path = 'products/' . $product->clave;
                } else {
                    $path = 'products/default';
                }
            }
        }
        return view('product/index', compact('products', 'title', 'user'));
    }

    /** Función para listar los productos de  sucursal /productoCO */
    public function indexCOP()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if ($user->type_user == User::CO) {
            $products = Product::where('branch_id', $user->branch_id)
                ->where([
                    'branch_id' => $user->branch_id
                ])
                ->whereIn('status_id', [2, 3, 4])
                ->whereNull('products.deleted_at')
                ->orderBy('clave', 'asc')
                ->get();
        } else {
            $products = Product::where('branch_id', $user->branch_id)
                ->where([
                    'branch_id' => $user->branch_id
                ])
                ->whereIn('status_id', [2, 3, 4])
                ->whereNull('products.deleted_at')
                ->orderBy('clave', 'asc')
                ->get();
        }
        $shops = Auth::user()->shop()->get();
        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        $statuses = Shop::all();

        $adapter = Storage::disk('s3')->getDriver()->getAdapter();
        foreach ($products as $product) {
            if ($product->image) {
                $path = env('S3_ENVIRONMENT') . '/' . 'products/' . $product->clave;
            } else {
                $path = env('S3_ENVIRONMENT') . '/' . 'products/default';
            }

            $command = $adapter->getClient()->getCommand('GetObject', [
                'Bucket' => $adapter->getBucket(),
                'Key' => $adapter->getPathPrefix() . $path
            ]);

            $command = $adapter->getClient()->getCommand('GetObject', [
                'Bucket' => $adapter->getBucket(),
                'Key' => $adapter->getPathPrefix() . $path
            ]);

            $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

            $product->image = (string) $result->getUri();
        }
        return view('product/index', compact('user', 'categories', 'lines', 'shops', 'statuses', 'products'));
    }
    /** Listar todos los  Porductos de la tienda  para los colaboradores /productosCO */
    public function indexCO()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        $shops = Auth::user()->shop()->get();
        foreach ($shops as $shop) {
            $grupo = $shop->shop_group_id;
        }

        $categories = Shop::find($shop_id)->categories()->get();
        $lines = Shop::find($shop_id)->lines()->get();
        //$statuses = Shop::find($shop_id)->statuss()->get();
        $statuses = Status::all();

        // if($grupo==null){
        // $products = Shop::find($shop_id)->products()->get();
        // }else{
        // $products = Product::join('shops', 'shops.id','=', 'products.shop_id')->where('shops.shop_group_id',$grupo)->get();
        // }

        $products = Product::where([
            'branch_id' => $user->branch_id
        ])
            ->whereIn('status_id', [2, 3, 4])
            ->whereNull('products.deleted_at')
            ->orderBy('clave', 'asc')
            ->get();
        //return $products;

        $adapter = Storage::disk('s3')->getDriver()->getAdapter();

        foreach ($products as $product) {
            if ($product->image) {

                $path = env('S3_ENVIRONMENT') . '/' . 'products/' . $product->clave;

                $command = $adapter->getClient()->getCommand('GetObject', [
                    'Bucket' => $adapter->getBucket(),
                    'Key' => $adapter->getPathPrefix() . $path
                ]);

                $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');

                $product->image = (string) $result->getUri();
            }
        }

        return view('product/productCO/index', compact('user', 'categories', 'lines', 'shops', 'statuses', 'products'));
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
        //$categories = Shop::find($category)->categories()->get();
        $categories = Category::where('shop_id', '=', NULL)->get();
        //$categories;
        //$lines = Shop::find($line)->lines()->get();
        $lines = Line::where('shop_id', '=', NULL)->get();
        //return $lines;
        $status = Auth::user()->shop->id;
        $statuses = Status::all();
        if ($user->branch_id) {
            $branches = Branch::where('municipality_id', $user->branch->municipality_id)
                ->where('shop_id', $user->shop_id)->get();
        } else {
            $branches = $user->shop->branches;
        }
        return view('product/add', compact('user', 'categories', 'lines', 'shops', 'statuses', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();.
        $branch = $request->branch_id;
        $category = Category::find($request->category_id);
        //return $category;
        $validator = Validator::make($request->all(), [
            'price_purchase' => Rule::requiredIf($category->type_product == 1),
            'pricepzt' => Rule::requiredIf($category->type_product == 1),
            'max_discountpz' => Rule::requiredIf($category->type_product == 1),
            'weigth' => Rule::requiredIf($category->type_product == 2),
            'price' => Rule::requiredIf($category->type_product == 2),
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'error' => 'Error en alguno de los campos'
            ];
            //return response()->json($response, $this->unprocessable);
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $date = date("Y-m-d");
        $branches = Auth::user()->shop->branches;
        $user = Auth::user();
        $branches = $user->shop->branches;
        $exist = Product::where('clave', $request->clave)
            ->where('shop_id', Auth::user()->shop->id)
            ->first();
        if ($exist) {
            return redirect('/sucursales/' . $branch . '/producto')->with('mesage', 'La Clave que intentas registrar ya existe!');
        }
        foreach ($branches as $product) {
            $total = $product->description;
            if ($total == $request->description) {
                return redirect('/sucursales/' . $branch . '/producto')->with('mesage', 'El nombre que intentas registrar ya existe!');
            }
        }

        $data = $request->all();
        $data['price'] = ($request->pricepzt) ? $request->pricepzt : $request->price;
        $data['discount'] = $request->max_discount ? $request->max_discount : 0;
        $data['user_id'] = Auth::user()->id;
        $data['price_purchase'] = $request->price_purchase;
        $data['status_id'] = $request->status_id;

        $category = Category::find($request->category_id);
        if ($category->type_product == 1) {
            $data['line_id'] = null;
            $data['weigth'] = null;
            $data['discount'] = $request->max_discountpz ? $request->max_discountpz : 0;
        } else if ($category->type_product == 2) {
            $line = Line::find($request->line_id);
            $data['price_purchase'] = $line->purchase_price * $request->weigth;
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

        if ($category->type_product == 1 && (!$data['price_purchase']) || !is_numeric($data['price_purchase'])) {
            return back()->with('categories', $categories)->withErrors(['el precio compra es requerido']);
        }
        /*if($category->type_product == 2 && (!$data['weigth']) || !is_numeric($data['weigth'])){
          return back()->with('categories', $categories)->withErrors(['Los gramos son requeridos']);
        }*/

        $product = new Product($data);
        $product->date_creation = $date;
        //return $request;
        if ($request->id_product) {
            $restored_product = Product::where('id', $request->id_product)
                ->withTrashed()
                ->get();
            foreach ($restored_product as $r) {
                $r->restored_at = $date;
                $r->save();
            }
            //return $restored_product;
        }

        if ($request->hasFile('image')) {
            $adapter = Storage::disk('s3')->getDriver()->getAdapter();
            $image = file_get_contents($request->file('image')->path());
            $base64Image = base64_encode($image);
            $path = 'products';
            $product->image = $this->saveImages($base64Image, $path, $product->clave);
        }

        $product->save();
        return redirect('/sucursales/' . $branch . '/producto')->with('mesage', 'El Producto  se ha agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $adapter = Storage::disk('s3')->getDriver()->getAdapter();
        if ($product->image) {
            $path = env('S3_ENVIRONMENT') . '/products/' . $product->clave;
        } else {
            $path = 'products/default';
        }

        $product->image = $this->getS3URL($path);
        //return $product;

        return view('product.show', ['product' => $product]);
    }

    public function showOne($id)
    {
        $product = Product::findOrFail($id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $shop = $user->shop;
        $product = Product::find($id);

        $categories = Category::where('shop_id', '=', NULL)
            ->whereTypeProduct($product->category->type_product)
            ->get();

        $lines = Line::where('shop_id', '=', NULL)->get();
        $branches = $shop->branches()->get();
        $statuses = Status::all();

        $reetiquetado = false;

        return view('product/edit', compact('product', 'categories', 'lines', 'shop', 'branches', 'statuses', 'user', 'reetiquetado'));
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
        $branch = $request->branch_id;
        $product = Product::findOrFail($id);
        //return $request;

        $exist = Product::where('clave', $request->clave)
            ->where('shop_id', Auth::user()->shop->id)
            ->count();

        if ($exist == 1 && $request->clave != $product->clave) {
            return redirect('/sucursales/' . $product->branch_id . '/producto')->with('mesage', 'La Clave que intentas registrar ya existe!');
        } else {

            if ($request->hasFile('image')) {
                $adapter = Storage::disk('s3')->getDriver()->getAdapter();
                $image = file_get_contents($request->file('image')->path());
                $base64Image = base64_encode($image);
                $path = 'products';
                $product->image = $this->saveImages($base64Image, $path, $product->clave);
            }


            $product->clave = $request->clave;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->line_id = $request->line_id;
            //$product->price = ($request->pricepzt) ? $request->pricepzt : $request->price;
            $product->discount = $request->max_discountpz ? $request->max_discountpz : 0;
            //$product->price= ($request->pricepzt) ? $request->pricepzt :0 ;
            $product->discount = $request->max_discount ? $request->max_discount : 0;
            $product->weigth = $request->weigth;
            $product->observations = $request->observations;

            $product->price_purchase = $request->price_purchase;
            //$product->discount = $request->discount;
            $product->price = $request->pricepzt;
            //$product->max_discountpz = $request->max_discountpz;
            $product->status_id = $request->status_id;
            $product->branch_id = $request->branch_id;
            //$product->inventory = $request->inventory;

            $category = Category::find($request->category_id);
            if ($category->type_product == 1) {
                $product['line_id'] = null;
                $product['weigth'] = null;
                $product['discount'] = $request->max_discountpz ? $request->max_discountpz : 0;
            } else if ($category->type_product == 2) {
                $line = Line::find($request->line_id);
                $product->price = $request->price;
                $product['price_purchase'] = $line->purchase_price * $request->weigth;
            }

            $product->save();
            return redirect('/sucursales/' . $product->branch_id . '/producto')->with('mesage', 'El producto se ha actualizado  exitosamente!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inTransfer = TransferProduct::whereProductId($id)->first();
        $inSale = SaleDetails::whereProductId($id)->first();

        if ($inTransfer) return response()->json(['success' => false, 'cause' => true]);
        else if ($inSale) return response()->json(['success' => false, 'cause' => false]);
        else {
            Product::destroy($id);
            return response()->json([
                'success' => true
            ]);
        }
        //Product::destroy($id);
        // return redirect('/productos')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
    }

    //PRODUCTOS DEVUELTOS EN VENTAS
    public function devuelto()
    {

        $user = Auth::user();
        if ($user->type_user == User::AA) {
            $products = Product::whereIn('discar_cause', [3, 4])
                ->where('shop_id', $user->shop_id)
                ->withTrashed()
                ->get();
        } elseif ($user->type_user == User::SA || $user->type_user == User::CO) {
            $products = Product::whereIn('discar_cause', [3, 4])
                ->where('shop_id', $user->shop_id)
                ->where('branch_id', $user->branch_id)
                ->withTrashed()
                ->get();
        }

        $adapter = Storage::disk('s3')->getDriver()->getAdapter();
        foreach ($products as $product) {
            if ($product->image) {
                $path = 'products/' . $product->clave;
            } else {
                $path = 'products/default';
            }
            $product->image = $this->getS3URL($path);
        }
        return view('product/devueltos', compact('products'));
    }

    public function reetiquetado($id)
    {
        $product = Product::withTrashed()->find($id)->restore();
        $product = Product::find($id);
        $product->restored_at = now();
        $product->discar_cause = null;
        $product->save();

        $user = Auth::user();
        $shop = $user->shop;
        $branches = $shop->branches()->get();
        $lines = Line::whereShopId(NULL)->get();
        $categories = Category::whereShopId(NULL)
            ->whereTypeProduct($product->category->type_product)
            ->get();

        $reetiquetado = true;

        $statuses = Status::all();

        return view('product/edit', compact('product', 'categories', 'lines', 'shop', 'branches', 'statuses', 'user', 'reetiquetado'));
    }

    public function restore($id)
    {
        //return $id;
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $product = Product::where('id', $id)->withTrashed()->get();
        foreach ($product as $p) {
            $p->deleted_at = null;
            $p->restored_at = $date;
            $p->status_id = 2;
            $p->discar_cause = null;
            $p->save();
            $p->date_creation = Now();
        }
        //return $product;

        return back();
    }

    /**TERMINA FUNCIONES DE CRUD DE PRODUCTOS */

    /**FUNCIONES DE REPORTES DE PDF */
    public function exportPdf()
    {
        $shop = $this->user->shop;
        $products = $shop->products()
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();

        $hour = $this->getHour();
        $date = $this->getDate();
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf = PDF::loadview(
            'product.pdf',
            compact('date', 'hour', 'products', 'shop')
        );
        return $pdf->stream('Productos.pdf');
    }
    /**
     * Funcion para la vista del Reporte por Producto por Sucursal status
     *
     ***/
    public function indexReports()
    {
        $shop = $this->user->shop;
        $branches = $shop->branches;
        $statuses = Status::all();
        $lines = Line::where('shop_id', NULL)->get();
        $categories = Category::where('shop_id', NULL)->get();
        $shop = Auth::user()->shop;

        return view('product.Reports.index', compact('shop', 'branches', 'statuses', 'lines', 'categories'));
    }

    public function statusReport(Request $request)
    {        //reporte completado
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $status = Status::findOrFail($request->status_id);
        $line = Line::find($request->line_id);
        $category = Category::findOrFail($request->category_id);
        $type = $request->type_product;
        $shop = $this->user->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $products = $this->user->shop->products()
            ->whereCategory_id($category->id)
            ->whereBranch_id($branch->id)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->whereStatus_id($status->id);

        if ($line) {
            $products = $products->whereLine_id($line->id);
        }

        if ($fecini == $fecter) {
            $products = $products->whereDate('updated_at', $fecini);
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $products = $products->whereBetween('updated_at', [$fecini, $fecter]);
        }

        if ($status->id == 1) { //vendidos
            $products = $products->has('sale_details')
                //->with('sale_details.sale.partials')
                ->with('sale_details')
                ->get();
            $products_by_status = $products
                ->pluck('sale_details')
                ->collapse();
            $utility = $products_by_status->sum('profit');
            $price = $products_by_status->sum('final_price');
        } else if ($status->id == 3) { //transfer
            $products = $products->has('transfer_products')
                ->with('transfer_products')
                ->get();
            $products_by_status = $products
                ->pluck('transfer_products')
                ->collapse();
        } else {
            $products = $products->get();
            $products_by_status = $products;
        }

        $price_purchase = $products->sum('price_purchase');
        $weigth = $products->sum('weigth');

        if ($status->id != 1) { //vendidos
            $price = $products->sum('final_price');
            $utility = $price_purchase - $price;
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        $pdf  = PDF::loadView('product.Reports.reportEstatus', compact('shop', 'line', 'category', 'status', 'products', 'hour', 'date', 'weigth', 'price_purchase', 'utility', 'products_by_status', 'price', 'type', 'branch'));
        return $pdf->stream('ReporteEstatus.pdf');
    }
    /**Termina el retorno del pdf */
    public function reportLinea(Request $request)
    {
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrfail($request->branch_id);
        $line = Line::findOrfail($request->line_id);
        $shop = $this->user->shop;

        $products = $this->user->shop->products()
            ->whereBranch_id($branch->id)
            ->whereLine_id($line->id)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave');

        if ($fecini == $fecter) {
            $products = $products->whereDate('updated_at', $fecini)->get();
        } else {
            $products = $products->whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()])->get();
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $weigth = $products->sum('weigth');
        $price = $products->sum('price');
        $price_purchase = $products->sum('price_purchase');
        $utility = $price - $price_purchase;

        $pdf = PDF::loadView('product.Reports.reportLinea', compact('shop', 'products', 'line', 'branch', 'weigth', 'price', 'price_purchase', 'utility', 'date', 'hour'));
        return $pdf->stream('ReporteLineas.pdf');
    }


    //**Reporte de Entradas De Prosuctos Por Fechas */
    public function reportInputLine(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $line = Line::findOrFail($request->line_id);
        $shop = $this->user->shop;

        $products = $this->user->shop->products()
            ->whereBranch_id($branch->id)
            ->whereLine_id($line->id)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();

        if ($fecini == $fecter) {
            $products = $products->whereDate('date_creation', $fecini);
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $products = $products->whereBetween('date_creation', [$fecini, $fecter]);
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('shop', 'products', 'branch', 'line', 'hour', 'date'));
        return $pdf->stream('ReporteEntradas.pdf');
    }
    //**  */
    public function reportLineaG(Request $request)
    {
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shop = $this->user->shop;

        $lines = $shop->products()
            ->join('lines', 'lines.id', 'products.line_id')
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave');

        if ($fecini == $fecter) {
            $lines = $lines->whereDate('products.updated_at', $fecini);
        } else {
            $lines = $lines->whereBetween('products.updated_at', [$fecini->subDay(), $fecter->addDay()]);
        }
        $products = $lines->get();
        $lines = $lines->select('lines.id', 'lines.name', DB::raw('SUM(products.weigth) as weigth, SUM(products.price) as price'))
            ->distinct('lines.name')
            ->groupBy('lines.id', 'lines.name')
            ->get();
        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.reportLineaGeneral', compact('shop', 'hour', 'date', 'products', 'lines'));
        return $pdf->stream('ReporteLineasGeneral.pdf');
    }

    //**  */
    public function reportPzGeneral(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();

        $shop = $this->user->shop;

        $categories = $shop->products()
            ->join('categories', 'categories.id', 'products.category_id')
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            // ->whereStatus_id(2);
            ->where('line_id', NULL);
        if ($fecini == $fecter) {
            $categories = $categories->whereDate('products.updated_at', $fecini);
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $categories = $categories->whereBetween('products.updated_at', [$fecini, $fecter]);
        }
        $products = $categories->get();

        $categories = $categories->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as price'))
            ->distinct('categories.name')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.reportPzGeneral', compact('categories', 'shop', 'hour', 'date', 'products'));
        return $pdf->stream('ReporteCategoriasPGeneral.pdf');
    }

    //** funcion para generar reporte general de todas las sucursales por productos gramos */
    public function generalStatusReport(Request $request)
    {
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shop = $this->user->shop;
        $category_type = $request->cat;

        $products = $this->user->shop->products()
            ->has('line')
            ->whereBetween('updated_at', [$fecini, $fecter])
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave');

        if ($fecini == $fecter) {
            $products = $products->whereDate('updated_at', $fecini)->get();
        } else {
            $products = $products->whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()])->get();
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $weight = $products->sum('weigth');
        $price = $products->sum('price');

        $pdf  = PDF::loadView('product.Reports.reportEstatusG', compact('shop', 'products', 'hour', 'date', 'category_type', 'weight', 'price'));
        return $pdf->stream('ReporteEstatusGeneral.pdf');
    }

    //** función que genera el reporte  general de productos por gramos */
    public function reportInputGeneralGr(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $branch = Branch::findOrFail($request->branch_id);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shop = $this->user->shop;

        $query = $shop->products()
            // ->has('line')
            ->join('lines', 'lines.id', 'products.line_id')
            ->whereBranch_id($branch->id);
        // ->orderByRaw('CHAR_LENGTH(clave)')
        // ->orderBy('clave');

        if ($fecini == $fecter) {
            $query = $query->whereDate('date_creation', $fecini);
        } else {
            $query = $query->whereBetween('date_creation', [$fecini->subDay(), $fecter->addDay()]);
        }

        $products = $query->get();

        $lines = $query->select('lines.id', 'lines.name', DB::raw('SUM(products.weigth) as weigth, SUM(products.price) as price'))
            ->distinct('lines.name')
            ->groupBy('lines.id', 'lines.name')
            ->get();

        $lines_weigth = 0;

        foreach ($lines as $l) {
            $lines_weigth += $l->weigth;
        }

        //return $lines_weigth;

        // return  $products;
        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.reportEntradasGeneralGr', compact('lines_weigth', 'shop', 'branch', 'lines', 'products', 'hour', 'date'));
        return $pdf->stream('R.EntradasGeneral_ppgr.pdf');
    }

    //** función que genera el reporte  general de productos por piezas */
    public function reportEntradasPr_gppz(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $branch = Branch::findOrFail($request->branch_id);
        $hour = $this->getHour();
        $date = $this->getDate();

        $shop = $this->user->shop;

        $categories = $shop->products()
            ->join('categories', 'categories.id', 'products.category_id')
            ->whereStatus_id(2)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->where('line_id', NULL);

        if ($fecini == $fecter) {
            $categories = $categories->whereDate('products.date_creation', $fecini);
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $categories = $categories->whereBetween('products.date_creation', [$fecini, $fecter]);
        }
        $products = $categories->get();

        $categories = $categories->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as price'))
            ->distinct('categories.name')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.reportEntradasPr_gppz', compact('branch', 'shop', 'branch', 'categories', 'products', 'hour', 'date'));
        return $pdf->stream('R.EntradasGeneralPr_gppz.pdf');
    }

    //** función que genera el reporte  general de productos por pieza-entradas **//
    public function reportEntradaspz(Request $request)
    {
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $branch = Branch::findOrFail($request->branch_id);
        $category = Category::findOrFail($request->category_id);
        $shop = $this->user->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $products = $this->user->shop->products()
            ->whereCategory_id($category->id)
            ->whereBranch_id($branch->id)
            ->whereStatus_id(2)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();


        if ($fecini == $fecter) {
            $products = $products->whereDate('date_creation', $fecini);
        } else {
            $fecini = $fecini->subDay();
            $fecter = $fecter->addDay();
            $products = $products->whereBetween('date_creation', [$fecini, $fecter]);
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        $price = $products->sum('price');
        $price_purchase = $products->sum('price_purchase');

        $pdf  = PDF::loadView('product.Reports.reportEntradasPz', compact('branch', 'category', 'shop', 'products', 'price', 'hour', 'date', 'price_purchase'));
        return $pdf->stream('R.EntradasGeneral_ppz.pdf');
    }

    /**Reporte para sacar la utilida de productos por pzs */
    public function reportProductpzs(Request $request)
    {
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $productos = Auth::user()->shop->id;
        $category = 1;
        $productos = Product::where('category_id', $category)->get();
        $sumprice = Product::where('category_id', $category)->sum('products.pricepzt');
        $sumprice_purchase = Product::where('category_id', $category)->sum('products.price_purchase');
        $adescuento = $request->descuento;
        $descuento = $sumprice * $request->descuento / 100;
        $total = $sumprice - $descuento;
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);

        $pdf  = PDF::loadView('product.Reports.reportProductpzs', compact('shop', 'shops', 'productos', 'sumprice', 'sumprice_purchase', 'descuento', 'total', 'dates', 'hour', 'adescuento'));
        return $pdf->stream('ReporteProductospzs.pdf');

        //return response()->json(['productos'=>$productos,'sumprice'=>$sumprice, 'utilida'=>$descuento, 'total'=>$total]);
    }

    public function reportUtility(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shop = $this->user->shop;
        $branch = Branch::findOrFail($request->branch_id);

        $category_type = $request->cat;
        $products = $shop->products()
            ->has('sale_details')
            ->with('sale_details')
            ->with('category')
            ->whereBranch_id($branch->id)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get()
            ->where('category.type_product', $category_type);

        if ($fecini == $fecter) {
            $products = $products->where('updated_at', $fecini);
            $expenses = Expense::where('updated_at', $fecini)
                ->whereBranch_id($branch->id);
        } else {
            $products = $products->whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()]);
            $expenses = Expense::whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()])->whereBranch_id($branch->id);
        }


        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        $sale_details = $products
            ->pluck('sale_details')
            ->collapse();

        $cash_expenses = $expenses->sum('price');
        $weight = $products->sum('weigth');
        $price = $sale_details->sum('final_price');
        $price_purchase = $products->sum('price_purchase');
        $utility = $sale_details->sum('profit');

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.UtilityReport', compact('shop', 'products', 'sale_details', 'hour', 'date', 'weight', 'price', 'price_purchase', 'utility', 'category_type', 'branch', 'cash_expenses'));
        return $pdf->stream('ReporteUtilidad.pdf');
    }

    public function reportUtilityGeneral(Request $request)
    {

        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();
        $shop = $this->user->shop;
        $branch = Branch::findOrFail($request->branch_id);

        $products = $shop->products()
            ->has('sale_details')
            ->with('sale_details')
            ->with('category')
            ->whereBranch_id($branch->id)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave')
            ->get();

        if ($fecini == $fecter) {
            $products = $products->where('updated_at', $fecini);
            $expenses = Expense::where('updated_at', $fecini)
                ->whereBranch_id($branch->id);
        } else {
            $products = $products->whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()]);
            $expenses = Expense::whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()])->whereBranch_id($branch->id);
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        $sale_details = $products
            ->pluck('sale_details')
            ->collapse();

        $cash_expenses = $expenses->sum('price');
        $weight = $products->sum('weigth');
        $price = $sale_details->sum('final_price');
        $price_purchase = $products->sum('price_purchase');
        $utility = $sale_details->sum('profit');

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        return $pdf  = PDF::loadView('product.Reports.UtilityReportGeneral', compact('shop', 'products', 'sale_details', 'hour', 'date', 'weight', 'price', 'price_purchase', 'utility', 'branch', 'cash_expenses'))->stream('ReporteUtilidad.pdf');
    }

    public function reportPz(Request $request)
    {

        $branch = Branch::findOrFail($request->branch_id);
        $category = Category::findOrfail($request->category_id);
        $shop = $this->user->shop;
        $fecini = Carbon::parse($request->fecini);
        $fecter = Carbon::parse($request->fecter);
        $hour = $this->getHour();
        $date = $this->getDate();

        $products = $shop->products()
            ->whereCategory_id($category->id)
            ->whereBranch_id($branch->id)
            ->whereStatus_id(2)
            ->orderByRaw('CHAR_LENGTH(clave)')
            ->orderBy('clave');

        if ($fecini == $fecter) {
            $products = $products->whereDate('updated_at', $fecini)->get();
        } else {
            $products = $products->whereBetween('updated_at', [$fecini->subDay(), $fecter->addDay()])->get();
        }

        if ($products->isEmpty()) {
            return back()->with('message', 'El reporte que se intento generar no contiene información');
        }

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $total  = $products->sum('price');

        $pdf  = PDF::loadView('product.Reports.reportPz', compact('category', 'shop', 'products', 'date', 'hour', 'total', 'branch'));
        return $pdf->stream('ReporteLineas.pdf');
    }

    protected function getDate()
    {
        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        return $date;
    }
    protected function getHour()
    {
        $hour = Carbon::now();
        $hour = date('H:i:s');
        return $hour;
    }


    public function index2()
    {
        return view('product/index2');
    }
}
