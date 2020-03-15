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
////////////////  resource (api and url)  ////////////////
Route::Resource('/iot','IotController')->middleware('verify_token');
Route::Resource('/beacon','BeaconController');
//Route::get('/beacon/{beacon}' , 'BeaconController@destroy')->middleware('auth');
Route::delete('/message/{message}' , 'IotController@destroy_message')->name('del_message');
Route::delete('/qrcode/{qrcode}' , 'IotController@destroy_qrcode')->name('del_qrcode');

Route::post('image/upload/store','CustomerController@store');


/////////////// app api /////////// /////////////

Route::get('/shop/home/getmessage/shopmessage' , 'BeaconController@get_home_message_shopmessage')->middleware('verify_token');
Route::post('/shop/messages/getmessages/shopmessage/message' , 'BeaconController@get_home_message_shopmessage_message')->middleware('verify_token');
Route::post('/shop/messages/getfavorite' , 'BeaconController@get_favorite')->middleware('verify_token');
Route::post('/qrcode' , 'IotController@qrcode')->middleware('verify_token');

//////////////////// app api race/////////////////
Route::get('/getrace', 'BeaconController@getrace')->middleware('auth:api');
Route::post('/startrace', 'BeaconController@startrace');
Route::post('/cancelrace', 'BeaconController@cancelrace');
Route::get('/record/points', 'CustomerController@record');

//Route::get('/customer/login' , 'CustomerController@customer_login');
Route::post('/customer/login', 'CustomerController@login');
Route::post('/customer/register', 'CustomerController@register');
Route::post('/customer/register/v2', 'CustomerController@register_v2');
Route::get('/customer/loggedin', 'CustomerController@getAuthUser')->middleware('verify_token');
Route::post('/customer/verify', 'CustomerController@verifyUser');
Route::post('/customer/refreshApi', 'CustomerController@refreshUser')->name('api.jwt.refresh');;
Route::get('customer/store' , 'CustomerController@store')->middleware('verify_token');
Route::get('/customer/follow' , 'CustomerController@followpost')->middleware('verify_token');
Route::get('/customer/unfollow' , 'CustomerController@unfollowpost')->middleware('verify_token');
Route::get('/customer/home/getmessage' , 'CustomerController@get_home_message')->middleware('verify_token');

/////////////////////////////////  Version-1 Api Offera   //////////////////////

Route::post('/v1/consumer/login', 'ConsumerV1Controller@login');
Route::post('/v1/consumer/register', 'ConsumerV1Controller@register');
Route::post('/v1/consumer/register/v2', 'ConsumerV1Controller@register_v2');
Route::get('/v1/consumer/loggedin', 'ConsumerV1Controller@getAuthUser')->middleware('verify_token');
Route::post('/v1/consumer/verify', 'ConsumerV1Controller@verifyUser');
Route::post('/v1/consumer/refreshApi', 'ConsumerV1Controller@refreshUser')->name('api.jwt.refresh');;
Route::get('/v1/consumer/store' , 'ConsumerV1Controller@store')->middleware('verify_token');
Route::get('/v1/consumer/follow' , 'ConsumerV1Controller@followpost')->middleware('verify_token');
Route::get('/v1/consumer/unfollow' , 'ConsumerV1Controller@unfollowpost')->middleware('verify_token');
Route::get('/v1/consumer/home/getmessage' , 'ConsumerV1Controller@get_home_message')->middleware('verify_token');



