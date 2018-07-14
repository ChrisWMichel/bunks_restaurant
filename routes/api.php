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
    Route::post('update_item/{id}', 'ItemController@updateItem');
    Route::resource('price', 'PriceController');
    Route::post('update_prices', 'PriceController@updatePrices');
    Route::post('/size/{id}', 'SizeController@storeSizePrice');
    Route::post('/update_size', 'SizeController@updateSize');

    Route::resource('/topping_cat', 'ToppingCatController');
    Route::resource('/topping_items', 'ToppingItemController');
}


