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

Auth::routes();

Route::resource('usuario', 'Auth\RegisterController');

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('tiendas','ShopController');



Route::group(['middleware' => ['auth']], function () {
    Route::get('test', 'BranchController@test');


  
//Tiendas
//Route::resource('tiendas', 'ShopController');

  
});



Route::get('lineaspdf', 'LineController@exportPdf');

Route::get('lineasexc', 'LineController@exportExcel');



//Taspasos
Route::resource('traspasos', 'TranferProductsController');
Route::resource('traspasosAA', 'TrasferUserController');
Route::get('traspasospdf', 'TranferProductsController@exportPdfall');

//Traspaso id PDF
Route::get('traspasopdf/{id}', 'TranferProductsController@exportPdf')->name('traspasopdf');

//Ventas CO
Route::get('ventasCO', 'SaleController@indexCO');

//Pagos 
Route::resource('pagos', 'PaymentsController');
//Productos
Route::get('productospdf', 'ProductController@exportPdf');

// Sucursal CO
Route::get('sucursal', 'BranchController@indexCo');

// Productos CO
Route::get('productosCO', 'ProductController@indexCo');
// Productos COP
Route::get('productoCO', 'ProductController@indexCOP');

Route::post('traspasos/respuesta', 'TranferProductsController@answerTransferRequest');

//Excel
//Route::resource('excel','ExcelController');

//Reporte Excel Productos Sucursal
Route::get('productossucursalreporte/{id}','BranchProductsExcelController@index')->name('productossucursalreporte');

//Usuarios Excel
//Route::resource('usuariosexcel','UserExcelController');

//Reporte
Route::get('homepdf', 'HomeController@exportPdf');

//Usuarios Activo
Route::get('/usuarios/activo/{id}', 'UserController@soft');

//Sucursales Producto
Route::resource('sucursales.producto', 'BranchProductsController');
Route::put('sucursalproducto.update', 'BranchProductsController@update')->name('sucursalproducto.update');
Route::get('sucursalproducto/{id}/edit', 'BranchProductsController@edit');
Route::get('sucursales/{id}/inventario', 'BranchProductsController@inventory'); 
Route::get('sucursal', 'BranchController@indexCo');
//Route::get('sucursalespdf{id}', 'TestController@exportPdf')->name('sucursalespdf');

//Sucursal Producto PDF
Route::get('sucursales/{id}/sucursalespdf', 'BranchProductsController@exportPdf');


//Productod AA
Route::get('productoAA/{id}/', 'ProductController@soft');

//Productos Sucursal
Route::get('productosdesucursal/{id}', 'ProductsBranchController@index');

//Mostrar Imagenes
Route::get('imagenes/{path}',function($path){
  return response()->file(storage_path($path));
})->where('path','.+')->name('images');

//Municipios
Route::resource('municipios', 'MunicipalityController');

//Estados
Route::resource('estados', 'StateController');

// Definicion de recursos anidados
Route::resource('estados.municipios', 'StateMunicipalityController');

Route::resource('sucursales.usuarios', 'BranchUserController');

//Vista para usuario AA
Route::resource('principal', 'PrincipalController');

/*Route::get('download', function (){
  $pdf = PDF::loadVIEW('principal');
  return $pdf->download();
})->name('download');*/
Route::get('download', 'PrincipalController@download')->name('download');

//Gastos
Route::resource('gastos' , 'ControllerExpenses');
//Gastos PDF
Route::get('gastospdf', 'ControllerExpenses@exportPdf');
//Nominas por usuario
Route::get('nomina', 'UserController@indexNomina');
Route::get('nominaspdf', 'UserController@nominasPdf');
//Recibo de nomina
Route::get('recibo', 'UserController@indexReceipt');
Route::get('recibopdf', 'UserController@receiptPDF');
Route::get('recibospdf', 'UserController@receiptallPDF');

Route::post('check-password', 'StateController@checkPassword');

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

//Productos
Route::resource('productos',  'ProductController');

//Shop
Route::resource('tiendas','ShopController');
  

});
*/
//PRODUCTS
Route::group(['middleware' => ['auth','BranchMiddleware','CategoryMiddleware','LineMiddleware']],function(){

  //Ventas
  Route::resource('ventas', 'SaleController');
  Route::resource('inventarios', 'InventoryController');

  Route::post('inventory/check', 'InventoryController@check'); 

  Route::get('productos', 'ProductController@index');
  Route::get('productos/create', 'ProductController@create');
  Route::post('/productos', 'ProductController@store');
  Route::get('/productos/{id}/edit', 'ProductController@edit');
  Route::get('/productos/{id}/show', 'ProductController@show');
  Route::put('/productos/{id}/update', 'ProductController@update')->name('productos.update');
  Route::delete('/productos/{id}','ProductController@destroy');

  Route::resource('/mayoristas', 'ClientController');
});

Route::group(['middleware' => ['auth']],function () {

  //Ventas PDF
  Route::get('ventaspdf', 'SaleController@exportPdfall');
  Route::get('/reportes_venta','saleController@reporstSale');
  Route::get('ventapdf/{id}', 'SaleController@exportPdf')->name('ventapdf');

  //SUCURSALES
  Route::get('sucursales/create', 'BranchController@create');
  Route::get('/sucursales', 'BranchController@index');
  Route::post('/sucursales', 'BranchController@store');
  Route::get('/sucursales/{id}/edit', 'BranchController@edit');
  Route::get('/sucursales/{id}/show', 'BranchController@show');
  Route::put('/sucursales/{id}/update', 'BranchController@update')->name('sucursales.update');
  Route::delete('/sucursales/{id}','BranchController@destroy');
  Route::get('/sucursales/corte', 'BranchController@boxcut');
  


  //LINEAS
  Route::get('lineas/create', 'LineController@create');
  Route::get('/lineas', 'LineController@index');
  Route::post('/lineas', 'LineController@store');
  Route::get('/lineas/{id}/edit', 'LineController@edit');
  Route::get('/lineas/{id}/show', 'LineController@show');
  Route::put('/lineas/{id}/update', 'LineController@update')->name('lineas.update');
  Route::delete('/lineas/{id}','LineController@destroy');

  //CATEGORIAS
  Route::get('categorias/create', 'CategoryController@create');
  Route::get('/categorias', 'CategoryController@index');
  Route::post('/categorias', 'CategoryController@store');
  Route::get('/categorias/{id}/edit', 'CategoryController@edit');
  Route::get('/categorias/{id}/show', 'CategoryController@show');
  Route::put('/categorias/{id}/update', 'CategoryController@update')->name('categorias.update');
  Route::delete('/categorias/{id}','CategoryController@destroy');

  //ESTATUS
  Route::get('status/create', 'StatusController@create');
  Route::get('/status', 'StatusController@index');
  Route::post('/status', 'StatusController@store');  
  Route::get('/status/{id}/edit', 'StatusController@edit');
  Route::get('/status/{id}/show', 'StatusController@show');
  Route::put('/status/{id}/update', 'StatusController@update')->name('status.update');
  Route::delete('/status/{id}','StatusController@destroy');
 
 
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

  /**Reportes Rutas y Vistas */
  Route::get('/reportes-productos','ProductController@reportProduct');
  Route::get('estatusproducto', 'ProductController@reportEstatus');
  Route::get('gramoslinea', 'ProductController@reportLineaG');
  Route::get('entradasproducto', 'ProductController@reportEntradas');

  Route::get('gramoslineageneral', 'ProductController@reportLineaGGeneral');
  Route::get('reportEstatusG', 'ProductController@reportEstatusG');
  Route::get('reportEntradasG', 'ProductController@reportEntradasG');
  Route::get('reportProductspzs', 'ProductController@reportProductpzs');
  
});

 