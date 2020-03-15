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


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Auth::routes();
//////////////////////////     get url //////////////////////
Route::get('/', 'IotController@main_page')->name('main-page');
Route::get('/home', 'IotController@home_screen')->middleware('auth')->name('home');
Route::get('/notif/create', 'IotController@notif')->middleware('auth' , 'user_active')->name('notif_create');
Route::get('/information/create', 'IotController@inform')->middleware('auth' , 'user_active')->name('information_create');
Route::get('/information/additional/create', 'IotController@additional_inform')->middleware('auth' , 'user_active')->name('information_add_create');
Route::get('/beacon', 'BeaconController@index')->middleware('auth')->name('beacon');
Route::get('/beacon/create', 'BeaconController@create')->middleware('auth'  , 'user_active')->name('beacon_create');
Route::get('/api/beacon/{beacon}/edit', 'BeaconController@edit')->middleware('auth'  , 'user_active')->name('beacon.edit');
Route::get('/record/table', 'IotController@index')->middleware('auth')->name('iot');
Route::get('get/data/datatable' , 'IotController@getdata')->middleware('auth')->name('datatable_getdata');
Route::get('/record/chart', 'IotController@indexchart')->middleware('auth')->name('iot-chart');
Route::get('/shops/beacons/manage', 'BeaconController@all_shop_beacons')->middleware('auth' , 'user_active')->name('shops-beacons');
Route::get('/shops/messages/manage', 'IotController@shops_messages_manage')->middleware('auth' , 'user_active')->name('shops_messages_manage');
Route::post('/beacon/change/status' , 'BeaconController@beacon_status_change')->middleware('auth');
//Route::get('/api/iot/create', 'IotController@create')->middleware('auth')->name('iot_create');
//Route::get('/iot/{iot}/edit', 'IotController@edit')->middleware('auth')->name('iot.create');
Route::get('/beacon/{beacon}', 'BeaconController@destroy')->middleware('auth', 'user_active')->name('beacon_destroy');
Route::get('/race/create', 'BeaconController@setrace')->middleware('auth')->name('shop_create');
Route::get('/race/status', 'BeaconController@racestatus')->middleware('auth')->name('shop_race_status');
Route::get('/profile', 'IotController@profile')->middleware('auth')->name('profile_create');
Route::get('/user/messages', 'IotController@user_messages_show')->middleware('auth')->name('user_messages_show');
Route::get('/message/create', 'IotController@message_create')->middleware('auth',  'user_active')->name('message_create');
Route::get('/shops/messages/manage', 'IotController@shops_messages_manage')->middleware('auth')->name('shops_messages_manage');
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();

    return redirect('/login');
});

Route::get('/qrcode/set/message', 'IotController@qrcode')->middleware('auth', 'user_active')->name('qrcode_create');
Route::post('/qrcode/generate', 'IotController@qrcode_generate')->middleware('auth')->name('qrcode_generate');


//////////////////////   post url ///////////////////////

//Route::post('/aaaa' , 'IotController@aaaa')->name('message_set');
Route::post('message/create' , 'BeaconController@message_create')->middleware('auth')->name('message_set');
Route::post('favorite/create' , 'BeaconController@setfavorite')->middleware('auth')->name('favorite_set');
Route::post('information/set' , 'IotController@setinform')->middleware('auth')->name('inform_set');
Route::post('information/additional/set' , 'IotController@setaddinform')->middleware('auth')->name('inform_add_set');
//Route::post('iot/specialrecord' , 'BeaconController@record')->middleware('auth')->name('beacon_record');
Route::post('setprofile' , 'BeaconController@setshop')->middleware('auth')->name('profile_set');
Route::post('beacon' , 'BeaconController@store')->middleware('auth')->name('beacon.store');
Route::post('api/notif/{notif}/edit', 'IotController@editnotif')->middleware('auth')->name('notif_edit');
Route::post('/api/notif/update', 'IotController@updatenotif')->name('notif_update');
Route::post('/ajax/ajax' , 'IotController@ajaxtest');
Route::post('information/additional/admin/set/group' , 'IotController@admin_set_group')->middleware('auth');
Route::post('information/additional/admin/set/location' , 'IotController@admin_set_location')->middleware('auth');


////////////////////   post url resource /////////////////////
Route::post('api/beacon' , 'BeaconController@store')->middleware('auth')->name('beacon.store');
//Route::post('home/jquery' , 'CustomerController@jquery')->name('jquery');
Route::post('/user/verify' , 'IotController@user_verify')->name('user_verify');
Route::post('answer/send' , 'IotController@answer_comment')->name('answer_comment');
Route::post('comment/send' , 'IotController@create_comment')->name('create_comment');
Route::post('admin/comment/send' , 'IotController@admin_create_comment')->name('admin_create_comment');

////////////////////////////  main page url ///////////////////////////////
Route::get('/download/apk' , 'BeaconController@download_apk')->name('download_apk');
Route::get('/buy/beacon' , 'BeaconController@beacon_buy')->name('beacon-buy');
Route::post('/beacon/setprice' , 'BeaconController@beacon_set_price');
Route::post('/customer/buy/beacon' , 'BeaconController@customer_buy_beacon')->name('customer_buy_beacon');

Route::get('test' , function(\Illuminate\Http\Request $request){
    return str_slug('salam bar hameh');
});