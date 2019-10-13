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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::post('/user/register', 'MyAuth\RegisterController@register');
Route::post('user/login', 'MyAuth\LoginController@login');

// product
Route::get('/product/list', 'ProductController@getAll');
Route::post('/product/detail', 'ProductController@getProductDetail');

// category
Route::get('/category/list', 'CategoryController@getAllCategory');
Route::post('/cart/add', 'CartController@insertCart');
