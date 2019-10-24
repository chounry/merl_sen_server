<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function(){

    // user
    Route::post('/user/get','MyAuth\LoginController@getUser');
    Route::post('/user/edit','MyAuth\RegisterController@edit');
    
    // cart
    Route::post('/cart/add', 'CartController@insertCart');
    Route::post('/cart/list', 'CartController@getAllCarts');
    Route::post('/cart/remove', 'CartController@removeCart');
    Route::post('/product/buy-with-cart', 'CartController@buyWithCarts');
    Route::post('/product/buy-with-product', 'CartController@buyWithProduct');

    // product
    Route::post('/product/list-by-user', 'ProductController@getListOwnProduct');

    // buying
    Route::post('/buying/get-buy-history', 'CartController@getBuyHistory');


});

// user
Route::post('/user/register', 'MyAuth\RegisterController@register');
Route::post('user/login', 'MyAuth\LoginController@login');
Route::get('user/unauthenticated', 'MyAuth\LoginController@unauthenticated')->name('unauthenticated');

// product
Route::post('/product/list-by-user', 'ProductController@getListProductBySeller');
Route::get('/product/list', 'ProductController@getAll');
Route::post('/product/detail', 'ProductController@getProductDetail');
Route::post('/category/product', 'ProductController@getProductByCategory');


// category
Route::get('/category/list', 'CategoryController@getAllCategory');

Route::get('/product/get-shop-list', 'UserController@getAll');

