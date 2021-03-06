<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('logout', 'Auth\LoginController@logout');

Route::resource('usuario', 'Auth\RegisterController');

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('tiendas', 'ShopController');

//Estados
Route::resource('estados', 'StateController');

// Definicion de recursos anidados
Route::resource('estados.municipios', 'StateMunicipalityController');


Route::group(['middleware' => ['auth']], function () {
    Route::get('test', 'BranchController@test');
    Route::get('/products', 'ProductController@serverSide');
    Route::get('/branch-products/{id}', 'BranchProductsController@serverSide');


    Route::get('/products', 'ProductController@serverSide');
    Route::get('/branches', 'BranchController@serverSide');
    Route::get('/products/{id}', 'ProductController@showOne');
    Route::get('/expenses', 'ExpensesController@serverSide');
    Route::get('/users', 'UserController@serverSide');
    Route::get('/branch-products/{id}', 'BranchProductsController@serverSide');
    Route::get('api/sold', 'SaleController@tableSold');
    Route::get('api/apart', 'SaleController@tableApart');
    Route::get('api/givedback', 'SaleController@tableGivedback');


    Route::get('sale/graphic', 'Sale\GraphicController');



    Route::group(
        [
            'namespace' => 'Branch'
        ],
        function () {
            Route::get('sucursal/{id}/productos-gramo', 'ProductBranchController@productsWithLine');
            Route::get('sucursal/{id}/productos-pieza', 'ProductBranchController@productsWithoutLine');
            Route::get('sucursal/{id}/productos', 'ProductBranchController@all');
        }
    );

    Route::group(
        [
            'namespace' => 'Transfer'
        ],
        function () {

            Route::resource('traspasos', 'TransferProductsController');
            Route::post('transfer/response', 'OptionsController@response');
            Route::post('transfer/pay', 'OptionsController@payTransfer');
            Route::post('transfer/cancel', 'OptionsController@giveBack');

            Route::group(
                [
                    'prefix' => 'transfer'
                ],
                function () {
                    Route::get('/transInt', 'ServerSideController@transInt');
                    Route::get('/transOut', 'ServerSideController@transOut');
                }
            );

            Route::group(
                [
                    'prefix' => 'graphic'
                ],
                function () {
                    Route::get('entrantes', 'GraphicController@transferInt');
                    Route::get('out', 'GraphicController@transferOut');
                }
            );

            Route::group(
                [
                    'namespace' => 'Reports'
                ],
                function () {
                    Route::get('/reportes-traspasos', 'TransferProductsController@index');
                    Route::get('traspasospdf', 'TransferProductsController@pdfAll');
                    Route::get('traspaso-entrante/{id}', 'TicketsController@incoming');
                    Route::get('traspaso-saliente/{id}', 'TicketsController@outgoing');
                    Route::get('reportTransfer', 'TransferProductsController@reportTransferStatus');
                    Route::get('reportTransferG', 'TransferProductsController@reportTransferGeneral');
                }
            );
        }
    );

    //Tiendas
    //Route::resource('tiendas', 'ShopController');

    Route::get('lineaspdf', 'LineController@exportPdf');

    Route::get('lineasexc', 'LineController@exportExcel');

    //Taspasos
    //Route::group(['middleware' => ['admin']],function(){

    Route::resource('traspasosExt', 'TransferExtController');

    //Traspaso id PDF

    //Ventas CO

    //Pagos
    Route::resource('pagos', 'PaymentsController');

    // Sucursal CO
    Route::get('sucursal', 'BranchController@indexCo');
    // Productos COP
    Route::get('sucursalproductoCO', 'ProductController@indexCOP');
    //Reporte
    Route::get('homepdf', 'HomeController@exportPdf');

    //Usuarios Activo
    Route::get('/usuarios/activo/{id}', 'UserController@soft');


    Route::group(['middleware' => ['auth', 'CategoryMiddleware', 'LineMiddleware']], function () {

        //Sucursales Producto
        Route::resource('sucursales.producto', 'BranchProductsController');
        Route::put('sucursalproducto.update', 'BranchProductsController@update')->name('sucursalproducto.update');
        Route::get('sucursalproducto/{id}/edit', 'BranchProductsController@edit');
        Route::get('sucursales/{id}/inventario', 'BranchProductsController@inventory');
        Route::get('productos-sucursal/{id}', 'BranchProductsController@exportPdf')->name('sucursalpdf');

        Route::get('sucursal', 'BranchController@indexCo');
        // Route::get('sucursalespdf{id}', 'BranchProductsController@exportPdf')->name('sucursalespdf');
    });

    //Sucursal Producto PDF

    //Productod AA
    Route::get('productoAA/{id}/', 'ProductController@soft');

    //Productos Sucursal
    Route::get('productosdesucursal/{id}', 'ProductsBranchController@index');

    //Mostrar Imagenes
    Route::get('imagenes/{path}', function ($path) {
        return response()->file(storage_path($path));
    })->where('path', '.+')->name('images');

    //Municipios
    Route::resource('municipios', 'MunicipalityController');

    Route::resource('sucursales.usuarios', 'BranchUserController');

    //Vista para usuario AA

    /*Route::get('download', function (){
  $pdf = PDF::loadVIEW('principal');
  return $pdf->download();
})->name('download');*/
    Route::get('download', 'PrincipalController@download')->name('download');

    //Gastos
    Route::resource('gastos', 'ExpensesController');
    Route::get('reportes-gastos', 'ExpensesController@reportExpense');
    //Gastos PDF
    //Route::get('gastopdf', 'ExpensesController@exportPdfall');
    Route::get('gastospdf', 'ExpensesController@exportPdf');
    Route::get('gastopdf/{id}', 'ExpensesController@exportPdfall')->name('gastopdf');
    Route::get('gastosucursal', 'ExpensesController@reportexpensebranch');
    //Nominas por usuario
    Route::get('nomina', 'UserController@indexNomina');
    Route::get('nominaspdf', 'UserController@nominasPdf');
    //Recibo de nomina
    Route::get('recibo', 'UserController@indexReceipt');
    Route::get('recibopdf', 'UserController@receiptPDF');
    Route::get('recibospdf', 'UserController@receiptallPDF');

    Route::post('check-password', 'StateController@checkPassword');
    //Comisiones
    Route::get('/comisiones', 'SalesComissionsController@index');
    Route::get('/reportcomission', 'SalesComissionsController@reportcomission');
    Route::get('comisionsucursal', 'SalesComissionsController@ComissionBranchPDF');
    Route::get('comisionusuario', 'SalesComissionsController@ComissionUserPDF');
});

/*
Route::group(['middleware' => ['auth','BranchMiddleware','CategoryMiddleware','LineMiddleware', 'ProductBranchMiddleware','ShopMiddleware','StatusMiddleware']], function () {

//Usuarios
Route::resource('usuarios', 'UserController');

//Sucursales
Route::resource('sucursales', 'BranchController');


//Lineas
Route::resource('lineas', 'LineController');

//categorias
Route::resource('categorias', 'CategoryController');

//Status
Route::resource('status', 'StatusController');

//Shop
Route::resource('tiendas','ShopController');


});
*/
//PRODUCTS
Route::group(['middleware' => ['auth', 'BranchMiddleware', 'CategoryMiddleware', 'LineMiddleware', 'InventoryMiddleware']], function () {

    //Ventas
    Route::resource('ventas', 'SaleController');
    Route::post('ventas/check', 'SaleController@check');
    Route::post('ventas/canceled', 'SaleController@canceled');
    Route::post('ventas/addProduct', 'SaleController@addProduct');
    Route::resource('inventarios', 'InventoryController');
    Route::get('reportinventarios', 'InventoryController@reportInventarios');
    Route::get('inventariospdf/{id}', 'InventoryController@inventariosPDF');
    Route::post('inventory/check', 'InventoryController@check');
    Route::post('check-user', 'StateController@checkUser');
    Route::get('inventarios/terminar/{id}', 'InventoryController@terminar');
    Route::get('/productos-inventario/{id}', 'InventoryController@search');

    Route::resource('productos', 'ProductController');
    Route::get('devueltos', 'ProductController@devuelto');
    Route::get('/productos/{id}/reetiquetado', 'ProductController@reetiquetado');
    Route::get('/productos/{id}/restore', 'ProductController@restore');

    Route::resource('/clientes', 'ClientController');
    Route::group(
        [
            'prefix' => 'clients'
        ],
        function () {
            Route::get('/retail', 'ClientController@retail');
            Route::get('/wholesale', 'ClientController@wholesale');
        }
    );
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    //Ventas PDF
    Route::get('/reportes_venta', 'saleController@reporstSale');
    Route::get('ventapdf/{id}', 'SaleController@exportPdf')->name('ventapdf');
    Route::resource('principal', 'PrincipalController');
    //SUCURSALES
    Route::get('sucursales/create', 'BranchController@create');
    Route::get('/sucursales', 'BranchController@index');
    Route::post('/sucursales', 'BranchController@store');
    Route::get('/sucursales/{id}/edit', 'BranchController@edit');
    Route::get('/sucursales/{id}/show', 'BranchController@show');
    Route::get('/sucursales/{id}/mostrar', 'BranchController@mostrar');
    Route::put('/sucursales/{id}/update', 'BranchController@update')->name('sucursales.update');
    Route::delete('/sucursales/{id}', 'BranchController@destroy');
    Route::get('/sucursales/corte', 'BranchController@boxcut');

    //LINEAS
    Route::get('lineas/create', 'LineController@create');
    Route::get('/lineas', 'LineController@index');
    Route::post('/lineas', 'LineController@store');
    Route::get('/lineas/{id}/edit', 'LineController@edit');
    Route::get('/lineas/{id}/show', 'LineController@show');
    Route::put('/lineas/{id}/update', 'LineController@update')->name('lineas.update');
    Route::delete('/lineas/{id}', 'LineController@destroy');

    //CATEGORIAS
    Route::get('categoriaspdf', 'CategoryController@exportPdf');
    Route::get('categorias/create', 'CategoryController@create');
    Route::get('/categorias', 'CategoryController@index');
    Route::post('/categorias', 'CategoryController@store');
    Route::get('/categorias/{id}/edit', 'CategoryController@edit');
    Route::get('/categorias/{id}/show', 'CategoryController@show');
    Route::put('/categorias/{id}/update', 'CategoryController@update')->name('categorias.update');
    Route::delete('/categorias/{id}', 'CategoryController@destroy');

    //ESTATUS
    Route::get('status/create', 'StatusController@create');
    Route::get('/status', 'StatusController@index');
    Route::post('/status', 'StatusController@store');
    Route::get('/status/{id}/edit', 'StatusController@edit');
    Route::get('/status/{id}/show', 'StatusController@show');
    Route::put('/status/{id}/update', 'StatusController@update')->name('status.update');
    Route::delete('/status/{id}', 'StatusController@destroy');


    //USUARIOS
    Route::get('usuarios/create', 'UserController@create');
    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuarios', 'UserController@store');
    Route::get('/usuarios/{id}/edit', 'UserController@edit');
    Route::get('/usuarios/{id}/show', 'UserController@show');
    Route::put('/usuarios/{id}/update', 'UserController@update')->name('usuarios.update');
    Route::delete('/usuarios/{id}', 'UserController@destroy');


    Route::get('/grupos', 'ShopGroupsController@index');
    Route::get('/grupos/crear', 'ShopGroupsController@create');
    Route::post('/grupos', 'ShopGroupsController@store');
    Route::get('/grupos/invitacion', 'ShopGroupsController@groupJoinForm');
    Route::post('/grupos/invitacion', 'ShopGroupsController@groupJoin');

    /**Reportes actualizados*/
    Route::get('reportes-productos', 'ProductController@indexReports');
    // Route::get('productospdf', 'ProductController@exportPdf');
    Route::get('estatus', 'ProductController@statusReport');
    Route::get('general-estatus', 'ProductController@generalStatusReport');
    Route::get('reportLinea', 'ProductController@reportLinea');
    Route::get('reportLineaG', 'ProductController@reportLineaG');
    Route::get('reportPz', 'ProductController@reportPz');
    Route::get('reportPzG', 'ProductController@reportPzGeneral');
    Route::get('reportUtility', 'ProductController@reportUtility');
    Route::get('reportUtilityGeneral', 'ProductController@reportUtilityGeneral');
    Route::get('entradas-linea', 'ProductController@reportInputLine');
    Route::get('entradas-general-gramos', 'ProductController@reportInputGeneralGr');
    Route::get('reportEntradaspz', 'ProductController@reportEntradaspz');
    Route::get('reportEntradasPrgppz', 'ProductController@reportEntradasPr_gppz');

    Route::get('ventaspdf', 'SaleController@exportPdfall');

    /**Fin reportes actualizados*/

    Route::get('/reportes-productos-apartados', 'ProductController@reportProductSeparated');
    Route::get('reportEntradasGpgr', 'ProductController@reportEntradasG_pgr');

    Route::get('sucursales/sucursalcorte', 'BranchController@reportBox_cutDate')->name('sucursalcorte');
    Route::get('piezascategoriageneral', 'ProductController@reportCategoriaPGeneral');
    Route::get('reportProductspzs', 'ProductController@reportProductpzs');
    Route::get('sucursales/sucursalcortediario/{id}', 'BranchController@DailyCashCut');
    Route::get('/Clientes', 'ClientController@IndexCO');

    Route::get('/Graficos', 'ChartController@index');
});

Auth::routes(['verify' => true]);
