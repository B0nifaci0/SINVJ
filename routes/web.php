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
Route::resource('tiendas', 'ShopController');

  
});

//Lineas
Route::resource('lineas', 'LineController');

Route::get('lineaspdf', 'LineController@exportPdf');

Route::get('lineasexc', 'LineController@exportExcel');

//categorias
Route::resource('categorias', 'CategoryController');

//Status
Route::resource('status', 'StatusController');


//Ventas
Route::resource('ventas', 'SaleController');

//Pagos
Route::resource('pagos', 'PaymentsController');
//Productos
Route::resource('productos', 'ProductController');

//Usuarios
Route::resource('usuarios', 'UserController');

//Sucursales
Route::resource('sucursales', 'BranchController');

//Excel
Route::resource('excel','ExcelController');

//Reporte Excel Productos Sucursal
Route::get('productossucursalreporte/{id}','BranchProductsExcelController@index')->name('productossucursalreporte');

//Usuarios Excel
Route::resource('usuariosexcel','UserExcelController');

//Usuarios Activo
Route::get('/usuarios/activo/{id}', 'UserController@soft');
//Sucursal Productos
Route::get('/sucursalproductos/{id}', 'BranchProductsController@index');

//Sucursales Producto
Route::resource('sucursales.producto', 'BranchProductsController');

//Productod AA
Route::get('productoAA/{id}/', 'ProductController@soft');

//Productos Sucursal
Route::get('productosdesucursal/{id}', 'ProductsBranchController@index');

//Mostrar Imagenes
Route::get('imagenes/{path}',function($path){
  return response()->file(storage_path($path));
})->where('path','.+')->name('images');

Route::get('lineas/{id}/destroy', [
    'uses' => 'LineController@destroy',
    'as' => 'lineas.destroy'

]);

Route::get('productos/{id}/destroy', [
  'uses' => 'ProductController@destroy',
  'as' => 'productos.destroy'
]);

Route::get('categorias/{id}/destroy', [
  'uses' => 'CategoryController@destroy',
  'as' => 'categorias.destroy'
]);

Route::get('status/{id}/destroy', [
  'uses' => 'StatusController@destroy',
  'as' => 'status.destroy'

]);

Route::get('sucursales/{id}/destroy', [
  'uses' => 'BranchController@destroy',
  'as' => 'branch.destroy'

]);

Route::resource('municipios', 'MunicipalityController');

Route::resource('estados', 'StateController');

// Definicion de recusrsos anidados
Route::resource('estados.municipios', 'StateMunicipalityController');



