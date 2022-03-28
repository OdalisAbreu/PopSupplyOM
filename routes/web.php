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
//https://akivaron.github.io/miminium/credits.html

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', 'TestController@welcome');

Auth::routes();

//bot
Route::get('botpro/{token}', 'CategoryController@bot');
Route::post('/botcart', 'CartController@store');
Route::delete('/botcart', 'CartController@destroy');
Route::post('/orderbot', 'OrderController@botorder');// Realizar orden




//General
Route::get('/search', 'SearchController@show');// Busqueda
Route::get('/home', 'OrderController@index')->name('home');// Manejo de ordenes
Route::get('/map', 'DirectionsController@map')->name('home'); // Vista del MApa


//Product
Route::get('products/json', 'SearchController@data'); //Vista Json de los productos
Route::get('products/{id}', 'ProductController@show'); // Vista producto especifico
Route::get('categories/{category}', 'CategoryController@show');

//Cart
Route::get('/car', 'HomeController@index')->name('home'); //Vista del carrito
Route::post('/cart', 'CartDetailController@store'); // Guardar Carrito
Route::delete('/cart', 'CartDetailController@destroy');//Eliminar carrito

//Order
Route::post('/order', 'CartController@update'); // Actualizar controler 
Route::get('orders/{id}/{status}', 'OrderController@editar'); // Editar status de orden
Route::get('order/{id}', 'PedidosController@show'); // Vista de impresion de la orden 
Route::get('order-pdf','PedidosController@exportPdf'); // Vista PDF de la orden

//Acceder a Storage
Route::get('storage-link', function(){
	Artisan::call('storage:link');
});

Route::middleware(['auth','admin'])->namespace('admin')->prefix('admin')->group(function () {
	Route::get('/products', 'ProductController@index'); //listar 
	Route::get('/products/create', 'ProductController@create'); //formulario para crear
	Route::post('/products', 'ProductController@store'); //crear
	Route::get('/products/{id}/edit', 'ProductController@edit'); //form editar
	Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar
	Route::post('/products/{id}/delete', 'ProductController@destroy'); //eliminar

	Route::get('/products/{id}/images', 'ImageController@index'); //listado imagenes 
	Route::post('/products/{id}/images', 'ImageController@store'); //registrar
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //eliminar image
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar 

	//category
	Route::get('/categories', 'CategoryController@index'); //listar 
	Route::get('/categories/create', 'CategoryController@create'); //formulario para crear
	Route::post('/categories', 'CategoryController@store'); //crear
	Route::get('/categories/{category}/edit', 'CategoryController@edit'); //form editar
	
	Route::post('/categories/{category}/edit', 'CategoryController@update'); //actualizar
	Route::delete('/categories/{category}', 'CategoryController@destroy'); //eliminar

	
});