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
    // can't retrieve item via SizeController, fixing this problem with this new function- in AddSizePrice.vue
    Route::get('getItem/{id}', 'ItemController@getItem');
    Route::resource('price', 'PriceController');
    Route::post('update_prices', 'PriceController@updatePrices');
    Route::post('/size/{id}', 'SizeController@storeSizePrice');
    Route::post('/update_size', 'SizeController@updateSize');

    Route::resource('/topping_cat', 'ToppingCatController');
    Route::resource('/topping_items', 'ToppingItemController');
    Route::post('/updat_topping_price', 'ToppingCostController@updatePrice');
}

    Route::post('/checkout', 'OrderController@checkout');

    Route::get('biz_info', 'BusinessInfoController@index');

    Route::post('create_employee', 'AdminController@createEmployee');
    Route::get('get_employees', 'AdminController@getEmployees');

if($this->middleware('isEmployee')){
    Route::get('/get_orders', 'OrderController@getOrders');
    Route::post('/order_complete/{id}', 'OrderController@orderComplete');
}

Route::post('update_address/{id}', 'UserController@updateAddress');
