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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('tiendas','ShopController');


Route::resource('tiendas','ShopController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('test', 'BranchController@test');


  
//Tiendas
//Route::resource('tiendas', 'ShopController');

  
});

//Lineas
Route::resource('lineas', 'LineController');

Route::get('lineaspdf', 'LineController@exportPdf');

Route::get('lineasexc', 'LineController@exportExcel');

//categorias
Route::resource('categorias', 'CategoryController');

//Status
Route::resource('status', 'StatusController');

//Taspasos
Route::resource('traspasos', 'TranferProductsController');
Route::get('traspasospdf', 'TranferProductsController@exportPdf');

//Traspaso id PDF
Route::get('traspasopdf/{id}', 'TranferProductsController@exportPdfall')->name('traspasopdf');

//Ventas
Route::resource('ventas', 'SaleController');
//Ventas CO
Route::get('ventasCO', 'SaleController@indexCO');

//Pagos
Route::resource('pagos', 'PaymentsController');
//Productos
Route::resource('productos', 'ProductController');
Route::get('productospdf', 'ProductController@exportPdf');

//Ventas PDF
Route::get('ventaspdf', 'SaleController@exportPdf');

//Usuarios
Route::resource('usuarios', 'UserController');

//Sucursales
Route::resource('sucursales', 'BranchController');

// Sucursal CO
Route::get('sucursal', 'BranchController@indexCo');

// Productos CO
Route::get('productosCO', 'ProductController@indexCo');
// Productos COP
Route::get('productosCOP', 'ProductController@indexCOP');

Route::post('traspasos/respuesta', 'TranferProductsController@answerTransferRequest');

//Excel
Route::resource('excel','ExcelController');

//Reporte Excel Productos Sucursal
Route::get('productossucursalreporte/{id}','BranchProductsExcelController@index')->name('productossucursalreporte');

//Usuarios Excel
Route::resource('usuariosexcel','UserExcelController');

//Reporte
Route::get('homepdf', 'HomeController@exportPdf');

//Usuarios Activo
Route::get('/usuarios/activo/{id}', 'UserController@soft');

//Sucursales Producto
Route::resource('sucursales.producto', 'BranchProductsController'); 
//Sucursal Producto PDF
Route::get('sucursalpdf/{id}', 'BranchProductsController@exportPdf')->name('sucursalpdf');


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


Route::resource('principal', 'PrincipalController');

//Gastos
Route::resource('gastos' , 'ControllerExpenses');
//Gastos PDF
Route::get('gastospdf', 'ControllerExpenses@exportPdf');


