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
    // cart
    Route::post('/cart/add', 'CartController@insertCart');
    Route::post('/cart/list', 'CartController@getAllCarts');
    Route::post('/cart/remove', 'CartController@removeCart');
});

// user
Route::post('/user/register', 'MyAuth\RegisterController@register');
Route::post('user/login', 'MyAuth\LoginController@login');
Route::get('user/unauthenticated', 'MyAuth\LoginController@unauthenticated')->name('unauthenticated');

// product
Route::get('/product/list', 'ProductController@getAll');
Route::post('/product/detail', 'ProductController@getProductDetail');

// category
Route::get('/category/list', 'CategoryController@getAllCategory');




