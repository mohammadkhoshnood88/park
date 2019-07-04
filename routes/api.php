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
////////////////  resource (api and url)  ////////////////
Route::Resource('/iot','IotController');
Route::Resource('/beacon','BeaconController');
//Route::get('/beacon/{beacon}' , 'BeaconController@destroy')->middleware('auth');
Route::delete('/message/{message}' , 'IotController@destroy_message')->name('del_message');

Route::post('image/upload/store','CustomerController@store');


/////////////// app api ////////////////////////
Route::post('/shop/follow' , 'BeaconController@followpost');
Route::get('/shop/home/getmessage' , 'BeaconController@get_home_message');
Route::get('/shop/home/getmessage/shopmessage' , 'BeaconController@get_home_message_shopmessage');
Route::post('/shop/messages/getmessages/shopmessage/message' , 'BeaconController@get_home_message_shopmessage_message');
Route::post('/shop/messages/getfavorite' , 'BeaconController@get_favorite');
Route::post('/qrcode' , 'IotController@qrcode');

//////////////////// app api race/////////////////
Route::get('/getrace', 'BeaconController@getrace')->middleware('auth:api');
Route::post('/startrace', 'BeaconController@startrace');
Route::post('/cancelrace', 'BeaconController@cancelrace');
Route::get('/record/points', 'CustomerController@record');