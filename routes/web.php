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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('tiendas','ShopController');



//categorias
Route::resource('categorias', 'CategoryController');

//Productos
Route::resource('productos', 'ProductController');

//Tiendas
Route::resource('tiendas', 'ShopController');

//Lineas
Route::resource('lineas', 'LineController');

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


