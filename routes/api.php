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
Route::Resource('/iot','IotController')->middleware('admin');
Route::post('image/upload/store','CustomerController@store');
Route::get('/notif/create' , 'IotController@notif');
Route::get('/information/create' , 'IotController@inform');
Route::Resource('/beacon','BeaconController');
Route::get('/beacon/{beacon}' , 'BeaconController@destroy');
Route::post('/information/set' , 'IotController@setinform');
Route::post('/iot/specialrecord' , 'BeaconController@record');
Route::put('/api/notif/{notif}/edit' , 'IotController@editnotif');