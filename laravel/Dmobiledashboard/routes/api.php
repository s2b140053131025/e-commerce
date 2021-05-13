<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//Auth User
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout');
Route::get('user', 'App\Http\Controllers\AuthController@getAuthUser');
// Product list 
Route::post('Addproduct','App\Http\Controllers\ProductController@CreateProduct');
Route::get('product','App\Http\Controllers\ProductController@productdisplay');
Route::post('productimg','App\Http\Controllers\ProductController@productSlider');
Route::get('productimg','App\Http\Controllers\ProductController@Sliderimages');


