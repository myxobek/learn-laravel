<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
Log::useFiles('php://stderr');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('products', 'ProductController@index');
    Route::post('products', 'ProductController@create');
    Route::put('products/{product}/buy', 'ProductController@buy');

    Route::get('vouchers', 'VoucherController@index');
    Route::post('vouchers', 'VoucherController@create');

    Route::post('vouchers/{voucher}/bind/products/{product}', 'ProductVoucherController@bind');
    Route::delete('vouchers/{voucher}/unbind/products/{product}', 'ProductVoucherController@unbind');
});