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


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

});

Route::get('/login_status', function (){
    return auth()->user();
});

Route::group(['middleware' => 'IsAdmin'], function (){

    Route::get('/admin', 'AdminController@index')->name('admin');

});
Route::group(['middleware' => 'IsEmployee'], function (){

    Route::get('/incoming_orders', 'OrderController@index')->name('incoming');

});

Route::post('/notify-admin', 'AdminController@notifyNewAdmin');

//Route::get('verify-admin/{token}', 'AdminController@receiveResetPassword')->name('verifyAdmin');

//Route::post('admin/reset', 'AdminController@resetPassword')->name('reset');

Route::post('reset/password', 'LogginCredController@SendResetPassword')->name('sendEmail');
Route::get('member/verify/{token}', 'LogginCredController@receiveResetPassword')->name('verify');
Route::post('member/reset', 'LogginCredController@resetPassword')->name('reset');

Route::get('/', 'CustomerController@index')->name('home');

