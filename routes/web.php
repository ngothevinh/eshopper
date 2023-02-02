<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\HomeController;
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

Route::get('/','HomeController@index')->name('home');
Route::get('/category/{slug}/{id}',[
    'as'=>'category.product',
    'uses'=>'CategoryController@index'
]);
Route::get('error',[
    'as'=>'error.product',
    'uses'=>'ErrorController@index'
]);


//Cart and checkout
Route::prefix('cart')->group(function () {
    Route::get('/showCart', [
        'as'=>'cart.showCart',
        'uses'=>'CartController@showCart'
    ]);
    Route::get('/addCart/{id}', [
        'as'=>'cart.add',
        'uses'=>'CartController@addCart'
    ]);
    Route::get('/updateCart', [
        'as'=>'cart.update',
        'uses'=>'CartController@updateCart'
    ]);
    Route::get('/deleteCart', [
        'as'=>'cart.delete',
        'uses'=>'CartController@deleteCart'
    ]);

    Route::post('/checkout', [
        'as'=>'cart.postCheckout',
        'uses'=>'CartController@postCheckout'
    ]);

    # Chi tiết sản phẩm
    Route::get('/detailProduct/{id}', [
        'as'=>'cart.detailProduct',
        'uses'=>'CartController@detailProduct'
    ]);

    # Danh sách tất cả sản phẩm
    Route::get('/productAll', [
        'as'=>'cart.productAll',
        'uses'=>'CartController@productAll'
    ]);

    # Tìm kiếm sản phẩm
    Route::get('/search', [
        'as'=>'cart.search',
        'uses'=>'CartController@search'
    ]);

});

