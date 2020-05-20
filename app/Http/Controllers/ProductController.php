<?php

namespace App\Http\Controllers;

use PDF;
use App\Line;
use App\Sale;
use App\Shop;
use App\User;
use App\Branch;
use App\Status;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\SaleDetails;
use App\TransferProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public function __construct()
    {
    }
    /** FUNCIONES PARA CRUD DE PRODUCTO */
    public function index()
    {
        $user = Auth::user();
        $shop_id = $user->shop->id;
        if ($user->type_user == User::CO) {
            $products = Product::where([
                'branch_id' => $user->branch_id,
                'status_id' => 2
            ])
                ->orderBy('clave', 'asc')->get();
        } else {
            $products = $user->shop->products;
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
        return view('product/index', compact('products'));
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
        return view('product/index', compact('products', 'title'));
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
                ->orderBy('clave', 'asc')
                ->get();
        } else {
            $products = Product::where('branch_id', $user->branch_id)
                ->where([
                    'branch_id' => $user->branch_id
                ])
                ->whereIn('status_id', [2, 3, 4])
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
        $statuses = Status::all();

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
        $user = Auth::user();
        $branches = $user->shop->branches;
        if ($user->shop->shop_group_id) {
            $group = $user->shop->shop_group_id;
            $categories = Category::where('shop_group_id', $group)->get();
            $lines = Line::where('shop_group_id', $group)->get();
            $rules = Category::join('business_rules','business_rules.id','categories.business_rule_id')
            ->select('business_rules.*','categories.id as category_id')
            ->where('categories.shop_group_id', $group)
            ->get();
        } else {
            $categories = $user->shop->categories;
            $lines = $user->shop->lines;
            $rules = Category::join('business_rules','business_rules.id','categories.business_rule_id')
            ->select('business_rules.*','categories.id as category_id')
            ->where('categories.shop_id', $user->shop_id)
            ->get();
        }
        //return $rules;
        return view('product/add', compact('branches', 'categories', 'lines', 'rules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $user = Auth::user();
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
        $branches = $user->shop->branches;
        $exist = Product::where('clave', $request->clave)
            ->where('shop_id', $user->shop->id)
            ->first();
        if ($exist) {
            return redirect('/productos')->with('mesage', 'La Clave que intentas registrar ya existe!');
        }
        foreach ($branches as $product) {
            $total = $product->description;
            if ($total == $request->description) {
                return redirect('/products')->with('mesage', 'El nombre que intentas registrar ya existe!');
            }
        }

        $data = $request->all();
        $data['price'] = ($request->pricepzt) ? $request->pricepzt : $request->price;
        $data['discount'] = $request->max_discount ? $request->max_discount : 0;
        $data['user_id'] = Auth::user()->id;
        $data['price_purchase'] = $request->price_purchase;
        $data['status_id'] = $request->status_id;
        $data['shop_id'] = $user->shop->id;

        $category = Category::find($request->category_id);
        if ($category->type_product == 1) {
            $data['line_id'] = null;
            $data['weigth'] = null;
            $data['discount'] = $request->max_discountpz ? $request->max_discountpz : 0;
        } else if ($category->type_product == 2) {
            $line = Line::find($request->line_id);
            $data['price_purchase'] = $line->purchase_price * $request->weigth;
        }

        $categories = $user->shop->categories()->get();
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
        //return $product;
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
        $user = Auth::user();
        $product = Product::find($id);
        $branches = $user->shop->branches;
        if ($user->shop->shop_group_id) {
            $group = $user->shop->shop_group_id;
            $categories = Category::where('shop_group_id', $group)->get();
            $lines = Line::where('shop_group_id', $group)->get();
        } else {
            $categories = $user->shop->categories;
            $lines = $user->shop->lines;
        }
        return view('product/edit', compact('product', 'categories', 'lines', 'branches'));
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
        $user = Auth::user();

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
        $product->discount = $request->max_discountpz ? $request->max_discountpz : 0;
        $product->discount = $request->max_discount ? $request->max_discount : 0;
        $product->weigth = $request->weigth;
        $product->observations = $request->observations;
        $product->price_purchase = $request->price_purchase;
        $product->price = $request->pricepzt;
        $product->status_id = $request->status_id;
        $product->branch_id = $request->branch_id;
        $product->shop_id = $user->shop->id;

        $category = Category::find($request->category_id);
        if ($category->type_product == 1) {
            $product['line_id'] = null;
            $product['weigth'] = null;
            $product['discount'] = $request->max_discountpz ? $request->max_discountpz : 0;
        } else if ($category->type_product == 2) {
            $line = Line::find($request->line_id);
            $product->price = $request->price;
            $data['price_purchase'] = $line->purchase_price * $request->weigth;
        }
        $product->save();

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
        $have = TransferProduct::where('product_id', $id)->get()->count();
        if ($have > 0) {
            return response()->json([
                'success' => false,
            ]);
        } else {
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
                ->where('restored_at', null)
                ->withTrashed()
                ->get();
        } elseif ($user->type_user == User::SA || $user->type_user == User::CO) {
            $products = Product::whereIn('discar_cause', [3, 4])
                ->where('shop_id', $user->shop_id)
                ->where('branch_id', $user->branch_id)
                ->where('restored_at', null)
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
        //return $products;
        return view('product/devueltos', compact('products'));
    }

    public function reetiquetado($id)
    {
        $user = Auth::user();
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $product = Product::onlyTrashed()
            ->where('id', $id)
            ->first();
        $category = Category::where('id', $product->category_id)->first();
        $branches = $user->shop->branches;
        if ($user->shop->shop_group_id) {
            $group = $user->shop->shop_group_id;
            $categories = Category::where('shop_group_id', $group)
                ->where('type_product', $category->type_product)
                ->get();
            $lines = Line::where('shop_group_id', $group)->get();
            //            return $categories;
        } else {
            $categories = $user->shop->categories;
            $categories = $categories->where('type_product', $category->type_product)->values();
            $lines = $user->shop->lines;
            //  return $categories;
        }
        $product->restored_at = $date;
        return view('product/reetiquetado', compact('product', 'categories', 'lines', 'branches'));
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


        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $pdf  = PDF::loadView('product.pdf', compact('shop', 'shops', 'dates', 'hour', 'user', 'categories', 'lines', 'shops', 'statuses', 'products'));
        return $pdf->stream('Productos.pdf');
    }
    /**
     * Funcion para la vista del Reporte por Producto por Sucursal status
     *
     ***/
    public function reportProduct()
    {

        if (Auth::user()->shop->products->count() == 0) {
            return redirect('/productos/create')->with('mesage', 'Primero debes crear productos!');
        }
        $idshop = Auth::user()->shop->id;
        $user = Auth::user();
        $tienda = Shop::find($idshop)->branches()->get();
        $statuses = Status::all();
        //$line = Shop::find($idshop)->lines()->get();
        $lineas = Line::where('shop_id', NULL)->get();
        $category = Auth::user()->shop->id;
        //$categories = Shop::find($category)->categories()->get();
        $categorias = Category::where('shop_id', NULL)->get();
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();
        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');


        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        //return $categories;

        return view('product.Reports.reportproduct', compact('hour', 'dates', 'shop', 'shops', 'tienda', 'user', 'statuses', 'lineas', 'categorias'));
    }

    public function reportEstatus(Request $request)
    {

        /**Codigo para hacer las validaciones de los campos para realizar las consultas para el reporte */
        $user = Auth::user()->shop->id;
        //$status = Shop::find($idshop)->statuss()->get();
        $status = Status::all();
        $line = Shop::find($idshop)->lines()->get();
        $category = Auth::user()->shop->id;
        $categories = Shop::find($category)->categories()->get();

        $trans = TransferProduct::all();

        /**Termina codigo de validacion de campos */

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        /**Codigo de las consultas de acuerdo a los campos que fueron seleccionados en los combos */

        if ($request->estatus_id == 3) {
            // $products = Product::join('transfer_products', 'transfer_products.product_id', 'products.id')
            //     ->where("products.branch_id", $request->branch_id)
            //     ->whereBetween('products.updated_at', [$fecini, $fecter])
            //     ->where("products.status_id", $request->estatus_id)
            //     ->where("products.category_id", $request->category_id)
            //     ->where("products.line_id", "=", $request->id)
            //     ->orderBy('products.clave', 'asc')
            //     ->get();
        }
        $branches = Branch::where("id", $request->branch_id)->get();
        foreach ($branches as $branch) {
            $branch = $branch->name;
        }

        $products = Product::where("branch_id", $request->branch_id)
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where("status_id", $request->estatus_id)
            ->where("category_id", $request->category_id)
            ->where("line_id", "=", $request->id)
            ->orderBy('clave', 'asc')
            ->get();


        $detalle = SaleDetails::all();

        $estado = Status::findOrFail($request->estatus_id);


        if ($request->type_product == 2)
            $type = "Gr";
        else
            $type = "Pz";

        /**Finaliza codigo de las consultas por campos seleccionados */

        /**Consultas para obtener el folio de la venta, la hora y el dia Uso de Carbon para las fechas y hora*/
        $sales = Sale::where("id", "=", "sale_id")->get();
        // $detalles = SaleDetail::where("sale_id",$sales->id);
        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $total = 0;
        foreach ($products as $product) {
            $total = $product->weigth + $total;
        }

        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $cash = 0;
        foreach ($products as $product) {
            $cash = $product->price + $cash;
        }

        $lines = Line::where("id", "=", $request->id)->get();

        $precio = 0;
        $venta = 0;
        foreach ($products as $product) {
            $precio = $product->price_purchase + $precio;
            foreach ($detalle as $det)
                if ($det->product_id == $product->id) {
                    $venta = $venta + $det->final_price;
                }
        }
        $compra = $precio;

        $utilidad = $venta - $compra;

        /**Finalizan consultas de folio de la venta, la hora y el dia */

        /**Variable para retornar los archivos que podran ser descargados en pdf
         * contiene las variables de las cuales se hicieron las consultas para poder
         * hacer uso de la informacion de cada consulta
         */

        $pdf  = PDF::loadView('product.Reports.reportEstatus', compact('shop', 'shops', 'estado', 'products', 'branch', 'sales', 'hour', 'dates', 'total', 'cash', 'compra', 'utilidad', 'trans', 'detalle', 'venta', 'type'))->setPaper('a4', 'landscape');
        //$pdf = $pdf->set_paper('a4', 'landscape');
        return $pdf->stream('ReporteEstatus.pdf');
    }
    /**Termina el retorno del pdf */
    public function reportLinea(Request $request)
    {
        $branches = Branch::where("id", "=", $request->branch_id)->get();
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();
        $lines = Line::where("id", "=", $request->id)->get();
        $products = Product::where("branch_id", "=", $request->branch_id)
            ->where("line_id", "=", $request->id)
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->orderBy('clave', 'asc')
            ->get();
        // return $products;
        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $total = 0;
        foreach ($products as $product) {
            $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach ($products as $product) {
            $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach ($lines as $line) {
            $precio = $line->purchase_price;
        }

        $compra = $total * $precio;
        $utilidad = $cash - $compra;


        $pdf  = PDF::loadView('product.Reports.reportLinea', compact('shop', 'shops', 'products', 'branches', 'lines', 'total', 'cash', 'compra', 'utilidad', 'dates', 'hour'));
        return $pdf->stream('ReporteLineas.pdf');
    }


    //**Reporte de Entradas De Prosuctos Por Fechas */
    public function reportEntradas(Request $request)
    {
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $hour = Carbon::now();
        $hour = date('H:i:s');
        $shop = Auth::user()->shop;
        $branch = Branch::find($request->branch_id);
        $line = Line::find($request->line_id);

        //$categories = Category::where("id","=",$request->id)->get();
        $products = Product::where("branch_id", "=", $request->branch_id)
            ->where("line_id", "=", $request->line_id)
            ->whereBetween('products.date_creation', [$fecini, $fecter])
            ->orderBy('clave', 'asc')
            ->get();
        $shops = Auth::user()->shop()->get();
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $pdf  = PDF::loadView('product.Reports.reportEntradas', compact('shop', 'shops', 'products', 'branch', 'line', 'hour', 'dates'));
        return $pdf->stream('ReporteEntradas.pdf');
    }
    //**  */
    public function reportLineaG(Request $request)
    {
        $branches = Auth::user()->shop->branches;
        $product = Auth::user()->shop->id;
        $products = Shop::find($product)->products()->get();
        $line = Auth::user()->shop->id;
        $lines = Shop::find($line)->lines()->get();
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();
        // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
        $categories = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->select('categories.name', 'categories.type_product')
            ->distinct('categories.name')
            ->where('categories.type_product', 1)
            ->get();
        // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR GRAMO
        $products = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->join('branches', 'branches.id', 'products.branch_id')
            ->join('lines', 'lines.id', 'products.line_id')
            ->select('products.*', 'lines.name as name_line', 'branches.name as name_branch', 'categories.name as name_category', 'categories.type_product', 'statuss.name as name_status')
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('categories.type_product', 2)
            ->where('products.deleted_at', NULL)
            ->where('products.status_id', 2)
            ->where('products.shop_id', Auth::user()->shop->id)
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

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $totals = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->join('lines', 'lines.id', 'products.line_id')
            ->where('products.deleted_at', NULL)
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('products.status_id', 2)
            ->where('lines.shop_id', NULL)
            ->where('products.shop_id', Auth::user()->shop->id)
            ->where('categories.type_product', 2)
            ->select('lines.id', 'lines.name', DB::raw('SUM(products.weigth) as total_w, SUM(products.price) as total_p'))
            ->distinct('lines.name')
            ->groupBy('lines.id', 'lines.name')
            ->get();

        $pdf  = PDF::loadView('product.Reports.reportLineaGeneral', compact('shop', 'hour', 'dates', 'shops', 'branches', 'lines', 'products', 'totals'));
        return $pdf->stream('ReporteLineasGeneral.pdf');
    }

    //**  */
    public function reportCategoriaGeneral()
    {

        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $branches = Auth::user()->shop->branches;
        $product = Auth::user()->shop->id;

        $line = Auth::user()->shop->id;
        $lines = Shop::find($line)->lines()->get();
        // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
        $categories = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->select('categories.name', 'categories.type_product')
            ->distinct('categories.name')
            ->where('categories.type_product', 1)
            ->get();
        // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR PIEZAS
        $products = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->join('branches', 'branches.id', 'products.branch_id')
            ->select('products.*', 'branches.name as name_branch', 'categories.name as name_category', 'categories.type_product', 'statuss.name as name_status')
            ->where('categories.type_product', 1)
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

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $cash = Category::join('products', 'products.category_id', 'categories.id')
            ->where('categories.shop_id', null)
            ->where('categories.type_product', 1)
            ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
            ->distinct('categories.name')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        $pdf  = PDF::loadView('product.Reports.reportCategoriaGeneral', compact('categories', 'shop', 'hour', 'dates', 'shops', 'branches', 'lines', 'products', 'cash'));
        return $pdf->stream('ReporteCategoriasPGeneral.pdf');
    }

    //** funcion para generar reporte general de todas las sucursales por productos gramos */
    public function reportEstatusG(Request $request)
    {
        ##en desarrollo
        $branches = Auth::user()->shop->branches;
        $id_shop = Auth::user()->shop->id;
        $lines = Shop::find($id_shop)->lines()->get();
        //return $lines;
        $categories = Shop::find($id_shop)->categories()->get();
        //return $categories;
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();
        $categoria = $request->cat;
        if ($categoria == 2) {
            $productsg = Shop::join('products', 'products.shop_id', 'shops.id')
                ->join('categories', 'categories.id', 'products.category_id')
                ->join('lines', 'lines.id', 'products.line_id')
                ->join('statuss', 'statuss.id', 'products.status_id')
                ->whereBetween('products.updated_at', [$fecini, $fecter])
                ->select('products.*', 'categories.name as name_category', 'lines.name as name_line', 'categories.type_product', 'statuss.name as name_status')
                ->where('categories.type_product', $request->cat)
                ->where('products.deleted_at', NULL)
                ->where('shops.id', $id_shop)
                ->OrderBy('products.clave', 'asc')
                ->get();
        } else {
            $productsg = Shop::join('products', 'products.shop_id', 'shops.id')
                ->join('categories', 'categories.id', 'products.category_id')
                ->join('statuss', 'statuss.id', 'products.status_id')
                ->whereBetween('products.updated_at', [$fecini, $fecter])
                ->select('products.*', 'categories.name as name_category', 'categories.type_product', 'statuss.name as name_status')
                ->where('categories.type_product', $request->cat)
                ->where('products.deleted_at', NULL)
                ->where('shops.id', $id_shop)
                ->OrderBy('products.clave', 'asc')
                ->get();
        }


        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $total = 0;
        foreach ($productsg as $product) {
            $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach ($productsg as $product) {
            $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach ($lines as $line) {
            $precio = $line->purchase_price;
        }

        $compra = $total * $precio;
        $utilidad = $cash - $compra;


        $pdf  = PDF::loadView('product.Reports.reportEstatusG', compact('shop', 'shops', 'branches', 'categories', 'id_shop', 'lines', 'productsg', 'total', 'cash', 'precio', 'hour', 'dates', 'compra', 'utilidad', 'categoria', 'categoria'));
        return $pdf->stream('ReporteEstatusGeneral.pdf');
    }

    //** función que genera el reporte  general de productos por gramos-entradas */
    public function reportEntradasG_pgr(Request $request)
    {
        $branches = Auth::user()->shop->branches;
        $shop_id = Auth::user()->shop->id;
        #pasar fecha actual
        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();
        $category_type_product = category::find($shop_id)->get();
        //return $category_type_product;
        $products = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('lines', 'lines.id', 'products.line_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->select('products.*', 'categories.name as name_category', 'lines.name as name_line', 'categories.type_product', 'statuss.name as name_status')
            ->whereBetween('products.date_creation', [$fecini, $fecter])
            ->where('products.branch_id', $request->branch_id)
            ->where('categories.type_product', 2)
            ->where('products.deleted_at', NULL)
            ->where('products.status_id', 2)->get();
        //return $products;
        // $status = Shop::find($shop_id)->statuss()->get();
        //return $status;
        $lines = Shop::find($shop_id)->lines()->get();
        foreach ($lines as $line) {
            $line->total_g = $products->where('line_id', $line->id)->sum('weigth');
        }
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $total = 0;
        foreach ($products as $product) {
            $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach ($products as $product) {
            $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach ($lines as $line) {
            $precio = $line->purchase_price;
        }

        $compra = $total * $precio;
        $utilidad = $cash - $compra;

        return $products;

        $pdf  = PDF::loadView('product.Reports.reportEntradasG_pgr', compact('shop', 'shops', 'branches', 'lines', 'products', 'total', 'cash', 'precio', 'hour', 'dates', 'compra', 'utilidad'));
        return $pdf->stream('R.EntradasGeneral_pgr.pdf');
    }

    //** función que genera el reporte  general de productos por gramos */
    public function reportEntradasPr_gpgr(Request $request)
    {
        $branches = Auth::user()->shop->branches;
        //return $request;
        $branch = Branch::find($request->branch_id);
        //return $branch;

        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $shop_id = Auth::user()->shop->id;
        #pasar fecha actual

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        //return $category_type_product;
        $products = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('lines', 'lines.id', 'products.line_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->select('products.*', 'categories.name as name_category', 'lines.name as name_line', 'categories.type_product', 'statuss.name as name_status')
            ->whereBetween('products.date_creation', [$fecini, $fecter])
            ->where('categories.type_product', 2)
            ->where('products.shop_id', $shop_id)
            ->where('products.deleted_at', NULL)
            ->where('products.status_id', 2)
            ->where('products.branch_id', $request->branch_id)->get();
        //return $products;
        // $status = Shop::find($shop_id)->statuss()->get();
        //return $status;
        $lines = Line::join('products', 'products.line_id', 'lines.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->where('lines.shop_id', NULL)
            ->where('products.shop_id', $shop_id)
            ->where('categories.type_product', 2)
            ->where('products.branch_id', $request->branch_id)
            ->whereBetween('products.date_creation', [$fecini, $fecter])
            ->select('lines.name as nombre_linea', DB::raw('SUM(products.weigth) as gramo_linea'))
            ->groupBy('lines.name')
            ->get();
        //return $lines;
        //FUNCION PARA CALCULAR EL TOTAL DE GRAMOS POR LINEA
        // return $lines;
        foreach ($lines as $line) {
            $line->total_g = $products->where('line_id', $line->id)->sum('weigth');
        }
        //return $line->total_g;

        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $total = 0;
        foreach ($products as $product) {
            $total = $product->weigth + $total;
        }

        $cash = 0;
        foreach ($products as $product) {
            $cash = $product->price + $cash;
        }

        $precio = 0;
        foreach ($lines as $line) {
            $precio = $line->purchase_price;
        }

        $compra = $total * $precio;
        $utilidad = $cash - $compra;

        //return $products;

        $pdf  = PDF::loadView('product.Reports.reportEntradasPr_gpgr', compact('branch', 'shop', 'shops', 'branches', 'lines', 'products', 'total', 'shop', 'shops', 'cash', 'precio', 'hour', 'dates', 'compra', 'utilidad'));
        return $pdf->stream('R.EntradasGeneral_ppgr.pdf');
    }

    //** función que genera el reporte  general de productos por piezas */
    public function reportEntradasPr_gppz(Request $request)
    {
        $branches = Auth::user()->shop->branches;
        $shop_id = Auth::user()->shop->id;
        $branch = Branch::find($request->branch_id);

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();
        #pasar fecha actual
        // FUNCION PARA SACAR LAS CATEGORIAS SIN REPETIRSE
        $categories = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->select('categories.name', 'categories.type_product')
            ->distinct('categories.name')
            ->where('categories.type_product', 1)
            ->get();
        // FUNCION PARA SACAR LOS PRODUCTOS PERTENECIENTES A CATEGORIAS POR PIEZAS
        $products = Shop::join('products', 'products.shop_id', 'shops.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            ->join('branches', 'branches.id', 'products.branch_id')
            ->select('products.*', 'categories.name as name_category', 'categories.type_product', 'statuss.name as name_status', 'branches.name as name_branch')
            ->where('categories.type_product', 1)
            ->where('products.shop_id', $shop_id)
            ->where('products.deleted_at', NULL)
            ->where('products.status_id', 2)
            ->where('products.branch_id', $request->branch_id)
            ->whereBetween('products.date_creation', [$fecini, $fecter])
            ->get();
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }


        $categories = Category::join('products', 'products.category_id', 'categories.id')
            ->where('categories.shop_id', NULL)
            ->where('products.shop_id', $shop_id)
            ->where('categories.type_product', 1)
            ->where('products.branch_id', $request->branch_id)
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('products.status_id', 2)
            ->where('products.deleted_at', NULL)
            ->select('categories.name as nombre_categoria', DB::raw('COUNT(products.id) as producto'))
            ->groupBy('categories.name')
            ->get();
        // return $categories;
        // FUNCION PARA CALCULAR LA SUMA TOTAL POR CATEGORIAS
        $totals = Category::join('products', 'products.category_id', 'categories.id')
            ->where('categories.shop_id', Auth::user()->shop->id)
            ->where('categories.type_product', 1)
            ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
            ->distinct('categories.name')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        $pdf  = PDF::loadView('product.Reports.reportEntradasPr_gppz', compact('branch', 'shop', 'shops', 'branches', 'categories', 'products', 'hour', 'dates', 'totals'));
        return $pdf->stream('R.EntradasGeneralPr_gppz.pdf');
    }

    //** función que genera el reporte  general de productos por pieza-entradas **//
    public function reportEntradasP_pz(Request $request)
    {
        $branches = Auth::user()->shop->branches;
        $shop_id = Auth::user()->shop->id;
        $branch = Branch::find($request->branch_id);
        //Resta un día a la fecha inicial
        $fecini = Carbon::parse($request->fecini)->subDay();
        //Aumenta un día a la fecha final
        $fecter = Carbon::parse($request->fecter)->addDay();

        $categories = Shop::find($shop_id)->categories()->get();
        //return $categories;
        $categories = Category::where('id', $request->category_id)
            ->select('categories.name as nombre_categoria')
            ->get();
        // return $categories;
        $products = Product::join('categories', 'categories.id', 'products.category_id')
            ->join('statuss', 'statuss.id', 'products.status_id')
            //Devuelve los resultados entre la fecha inicial y la fecha final
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('products.branch_id', $request->branch_id)
            ->where('products.category_id', $request->category_id)
            ->where('categories.type_product', 1)
            ->where('products.deleted_at', NULL)
            ->where('products.status_id', 2)
            ->select('products.*', 'categories.name as name_category', 'statuss.name as name_status', 'categories.type_product')
            ->get();
        //return $products;
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        //return $products;
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        foreach ($categories as $categorie) {
            $categorie->total_s = $products->where('category_id', $categorie->id)->sum('price');
        }
        //return $categorie->total_s;

        $total_sale_price = 0;
        foreach ($products as $product) {
            $total_sale_price = $product->pricepzt;
        }

        //$compra = $total * $precio;
        //$utilidad = $cash - $compra;

        //return $total_sale_price;

        $pdf  = PDF::loadView('product.Reports.reportEntradasGppz', compact('branch', 'shop', 'shops', 'branches', 'categories', 'products', 'total_sale_price', 'hour', 'dates'));
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

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        /**Codigo de las consultas de acuerdo a los campos que fueron seleccionados en los combos */

        $branches = Branch::where("id", "=", $request->branch_id)->get();
        $products = Product::where("branch_id", "=", $request->branch_id)
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('sale_details', 'sale_details.product_id', 'products.id')
            ->select('products.*', 'categories.type_product as tipo', 'sale_details.product_id as id_product', 'sale_details.final_price as final_price', 'sale_details.profit as profit')
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('categories.type_product', $request->cat)
            ->where("status_id", "=", 1)
            ->get();


        /**Finaliza codigo de las consultas por campos seleccionados */

        /**Consultas para obtener el folio de la venta, la hora y el dia Uso de Carbon para las fechas y hora*/
        $sales = Sale::where("id", "=", "sale_id")->get();

        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');

        $total = 0;
        foreach ($products as $product) {
            $total = $product->weigth + $total;
        }

        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }

        $cash = 0;
        foreach ($products as $product) {
            $cash = $product->price + $cash;
        }

        $lines = Line::where("id", "=", $request->id)->get();

        $precio = 0;
        foreach ($lines as $line) {
            $precio = $line->purchase_price;
            $discount = $line->discount;
        }

        $venta = 0;
        foreach ($products as $product) {
            $precio = $product->price_purchase + $precio;
            $venta = $venta + $product->final_price;
        }

        $compra = $precio;
        $utilidad = $venta - $compra;
        $pdf  = PDF::loadView('product.Reports.UtilityReport', compact('shop', 'shops', 'products', 'branches', 'sales', 'hour', 'dates', 'total', 'cash', 'compra', 'utilidad', 'lines', 'venta', 'categoria'));
        return $pdf->stream('ReporteUtilidad.pdf');
    }

    public function reportPz(Request $request)
    {
        $branches = Branch::where("id", "=", $request->branch_id)->get();
        $categoria = Category::where("id", $request->category_id)->get();

        //return $categories;
        //return $categories;

        $fecini = Carbon::parse($request->fecini)->subDay();
        $fecter = Carbon::parse($request->fecter)->addDay();

        $products = Product::where('branch_id', $request->branch_id)
            ->whereBetween('updated_at', [$fecini, $fecter])
            ->where('category_id', $request->category_id)
            ->orderBy('clave', 'asc')
            ->get();
        //return $products;

        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');
        $shop_id = Auth::user()->shop->id;
        $shop = Auth::user()->shop;
        $shops = Auth::user()->shop()->get();

        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }


        $cash = Category::join('products', 'products.category_id', 'categories.id')
            ->where('categories.shop_id', null)
            //->where('categories.type_product', $request->cat)
            ->where('categories.id', $request->category_id)
            ->where('products.shop_id', Auth::user()->shop->id)
            ->select('categories.id', 'categories.name', DB::raw('SUM(products.price) as total'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        //return $cash;


        $categories = Category::join('products', 'products.category_id', 'categories.id')
            ->where('categories.shop_id', NULL)
            ->where('products.shop_id', $shop_id)
            ->where('categories.type_product', 1)
            ->where('products.branch_id', $request->branch_id)
            ->whereBetween('products.updated_at', [$fecini, $fecter])
            ->where('products.status_id', 2)
            ->where('products.deleted_at', NULL)
            ->select('categories.name as nombre_categoria', DB::raw('COUNT(products.id) as producto'))
            ->groupBy('categories.name')
            ->get();
        //return $categories;

        $pdf  = PDF::loadView('product.Reports.reportCategoria', compact('categoria', 'categories', 'shop', 'shops', 'products', 'branches', 'dates', 'hour', 'cash'));
        return $pdf->stream('ReporteLineas.pdf');
    }
}
