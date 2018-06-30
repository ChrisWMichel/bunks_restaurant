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


if($this->middleware('IsAdmin')){
    Route::get('/get_admins', 'AdminController@getAdmins');
    Route::resource('category', 'CategoryController');
    Route::resource('items', 'ItemController');
    Route::resource('price', 'PriceController');
    Route::post('/size/{id}', 'SizeController@storeSizePrice');
}


