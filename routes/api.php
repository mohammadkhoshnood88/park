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
Route::Resource('/iot','IotController');
Route::post('image/upload/store','CustomerController@store');

Route::Resource('/beacon','BeaconController')->middleware('auth:api');
Route::get('/beacon/{beacon}' , 'BeaconController@destroy')->middleware('auth');
Route::post('/information/set' , 'IotController@setinform');
Route::post('/iot/specialrecord' , 'BeaconController@record');

Route::post('/setshop' , 'BeaconController@setshop');
Route::get('/getrace', 'BeaconController@getrace')->middleware('auth:api');
Route::post('/startrace', 'BeaconController@startrace');
Route::post('/cancelrace', 'BeaconController@cancelrace');
Route::get('/record/points', 'CustomerController@record');
