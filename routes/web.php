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



Route::group(['middleware' => ['auth']], function () {
    Route::get('test', 'BranchController@test');


  
//Tiendas
//Route::resource('tiendas', 'ShopController');

  
});



Route::get('lineaspdf', 'LineController@exportPdf');

Route::get('lineasexc', 'LineController@exportExcel');



//Taspasos
Route::resource('traspasos', 'TranferProductsController');
//Route::get('traspasospdf', 'TranferProductsController@exportPdf');

//Traspaso id PDF
Route::get('traspasopdf/{id}', 'TranferProductsController@exportPdf')->name('traspasopdf');

//Ventas
Route::resource('ventas', 'SaleController');
//Ventas CO
Route::get('ventasCO', 'SaleController@indexCO');

//Pagos 
Route::resource('pagos', 'PaymentsController');
//Productos
Route::get('productospdf', 'ProductController@exportPdf');

//Ventas PDF
Route::get('ventaspdf', 'SaleController@exportPdf');



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
Route::resource('sucursal', 'TestController');
Route::get('sucursalespdf{id}', 'TestController@exportPdf')->name('sucursalespdf');

//Sucursal Producto PDF
//Route::get('sucursalpdf/{id}', 'BranchProductsController@exportPdf')->name('sucursalpdf');


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
Route::get('nominaspdf', 'UserController@nominasPdf');

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

Route::group(['middleware' => ['auth','BranchMiddleware','CategoryMiddleware','LineMiddleware', 'ProductBranchMiddleware','ShopMiddleware','StatusMiddleware']], function () {
  Route::get('productos', 'ProductController@index');
});
Route::group(['middleware' => ['auth']], function () {

  //SUCURSALES
  Route::get('sucursales/create', 'BranchController@create');
  Route::get('/sucursales', 'BranchController@index');
  Route::post('/sucursales', 'BranchController@store');
  Route::get('/sucursales/{id}/edit', 'BranchController@edit');
  Route::get('/sucursales/{id}/show', 'BranchController@show');
  Route::put('/sucursales/{id}/update', 'BranchController@update')->name('sucursales.update');
  Route::delete('/sucursales/{id}/delete');

  //LINEAS
  Route::get('lineas/create', 'LineController@create');
  Route::get('/lineas', 'LineController@index');
  Route::post('/lineas', 'LineController@store');
  Route::get('/lineas/{id}/edit', 'LineController@edit');
  Route::get('/lineas/{id}/show', 'LineController@show');
  Route::put('/lineas/{id}/update', 'LineController@update')->name('lineas.update');
  Route::delete('/lineas/{id}/delete');

  //CATEGORIAS
  Route::get('categorias/create', 'CategoryController@create');
  Route::get('/categorias', 'CategoryController@index');
  Route::post('/categorias', 'CategoryController@store');
  Route::get('/categorias/{id}/edit', 'CategoryController@edit');
  Route::get('/categorias/{id}/show', 'CategoryController@show');
  Route::put('/categorias/{id}/update', 'CategoryController@update')->name('categorias.update');
  Route::delete('/categorias/{id}/delete');

  //ESTATUS
  Route::get('status/create', 'StatusController@create');
  Route::get('/status', 'StatusController@index');
  Route::post('/status', 'StatusController@store');
  Route::get('/status/{id}/edit', 'StatusController@edit');
  Route::get('/status/{id}/show', 'StatusController@show');
  Route::put('/status/{id}/update', 'StatusController@update')->name('status.update');
  Route::delete('/status/{id}/delete');

  //PRODUCTOS
  Route::get('productos/create', 'ProductController@create');
  Route::get('/productos', 'ProductController@index');
  Route::post('/productos', 'ProductController@store');
  Route::get('/productos/{id}/edit', 'ProductController@edit');
  Route::get('/productos/{id}/show', 'ProductController@show');
  Route::put('/productos/{id}/update', 'ProductController@update')->name('productos.update');
  Route::delete('/productos/{id}/delete');

  //USUARIOS
  Route::get('usuarios/create', 'UserController@create');
  Route::get('/usuarios', 'UserController@index');
  Route::post('/usuarios', 'UserController@store');
  Route::get('/usuarios/{id}/edit', 'UserController@edit');
  Route::get('/usuarios/{id}/show', 'UserController@show');
  Route::put('/usuarios/{id}/update', 'UserController@update')->name('usuarios.update');
  Route::delete('/usuarios/{id}/delete');


  Route::get('/grupos', 'ShopGroupsController@index');
  Route::get('/grupos/crear', 'ShopGroupsController@create');
  Route::post('/grupos', 'ShopGroupsController@store');
  Route::get('/grupos/invitacion', 'ShopGroupsController@groupJoinForm');
  Route::post('/grupos/invitacion', 'ShopGroupsController@groupJoin');

});

