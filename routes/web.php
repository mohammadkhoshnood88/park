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

Route::get('/', function () {

    return view('welcome');
})->middleware('auth');
Auth::routes();
Route::get('/waiting', function () {

    return view('profile');
    return "<div style='background: #2176bd;border: 1px solid saddlebrown;margin: 10px'><h2 style='text-align: center;'>شما در صف تایید قرار گرفتید<br/>لطفا منتظر بمانید
</h2><h5 style='text-align: center;'><a href='/login'>فرم ورود</a></h5></div>";
});
//////////////////////
//api
//////////////////////
Route::get('/api/notif/create', 'IotController@notif')->middleware('auth');
//Route::post('/notif/{notif}/edit', 'IotController@editnotif')->middleware('auth:web');
//Route::post('/notif/update', 'IotController@updatenotif')->middleware('auth');
Route::get('api/information/create', 'IotController@inform')->middleware('auth');
//Route::Resource('/beacon', 'BeaconController')->middleware('auth:api');
Route::get('/api/beacon', 'BeaconController@index')->middleware('auth');
Route::get('/api/beacon/create', 'BeaconController@create')->middleware('auth');
Route::get('/api/beacon/{beacon}/edit', 'BeaconController@edit')->middleware('auth');
Route::get('/api/iot', 'IotController@index')->middleware('auth');
Route::get('/api/iot/create', 'IotController@create')->middleware('auth');
Route::get('/api/iot/{iot}/edit', 'IotController@edit')->middleware('auth');
Route::get('/api/beacon/{beacon}', 'BeaconController@destroy')->middleware('auth');
Route::get('/api/setshop', 'BeaconController@showshop')->middleware('auth');


Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/login');
});