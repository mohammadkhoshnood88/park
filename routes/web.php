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
//////////////////////////     get url //////////////////////
Route::get('/', function () {
//    return view('home');

//    $favorite = \App\Favorite::where('id' , '1')->get();
//    return "<img src=\"/public/favorites/photos/1560236180cp-ssl4.png\">";

    $profile = \App\Shop::all()->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id);
//    return count($profile);
    $beacon_admin = \App\Beacon::all()->count();
    $user_admin = \App\User::all()->count();
    $unique_user_shop = \Illuminate\Support\Facades\DB::table('iots')
        ->join('beacons', 'iots.beacon_id', '=', 'beacons.mac_address')
        ->select('iots.*')
        ->get();
    $unicount = count($unique_user_shop);
    $beacon_shop = \App\Beacon::all()->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->count();
    $race_shop = \App\Race::all()->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->count();
    $visit_r_shop = \Illuminate\Support\Facades\DB::table('iots')
        ->join('beacons', 'iots.beacon_id', '=', 'beacons.mac_address')
        ->select('iots.*')
        ->get();
    $count= array();
     foreach ($visit_r_shop as $k=>$v_r_s){
        $count[$k] = $v_r_s->count;
     }
     $visit_shop = array_sum($count);


    return view('welcome', compact('beacon_admin', 'user_admin' , 'beacon_shop' , 'race_shop' , 'visit_shop' , 'profile' , 'unicount'));
})->middleware('auth');
Route::get('/waiting', function () {

    return "<div style='background: #2176bd;border: 1px solid saddlebrown;margin: 50px; box-shadow: 10px 10px 25px black'><h2 style='text-align: center;'>شما در صف تایید قرار گرفتید<br/>لطفا منتظر بمانید
</h2><h5 style='text-align: center;'><a href='/pacespace/login'>فرم ورود</a></h5></div>";
});
Route::get('/api/notif/create', 'IotController@notif')->middleware('auth')->name('notif_create');
Route::get('api/information/create', 'IotController@inform')->middleware('auth')->name('information_create');
Route::get('/api/beacon', 'BeaconController@index')->middleware('auth')->name('beacon');
Route::get('/api/beacon/create', 'BeaconController@create')->middleware('auth')->name('beacon_create');
Route::get('/api/beacon/{beacon}/edit', 'BeaconController@edit')->middleware('auth')->name('beacon.edit');
Route::get('/api/iot', 'IotController@index')->middleware('auth')->name('iot');
Route::get('/api/iot/create', 'IotController@create')->middleware('auth')->name('iot_create');
Route::get('/api/iot/{iot}/edit', 'IotController@edit')->middleware('auth')->name('iot.create');
Route::get('/api/beacon/{beacon}', 'BeaconController@destroy')->middleware('auth')->name('beacon_destroy');
Route::get('/api/setshop', 'BeaconController@showshop')->middleware('auth')->name('shop_create');
Route::get('/api/profile', 'IotController@profile')->middleware('auth')->name('profile_create');
Route::get('/api/message/create', 'IotController@message_create')->middleware('auth')->name('message_create');
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/login');
});

Route::get('/api/qrcode/create', 'IotController@qrcode')->middleware('auth')->name('qrcode_create');


//////////////////////   post url ///////////////////////

//Route::post('/aaaa' , 'IotController@aaaa')->name('message_set');
Route::post('api/message/create' , 'BeaconController@message_create')->middleware('auth')->name('message_set');
Route::post('api/favorite/create' , 'BeaconController@setfavorite')->middleware('auth')->name('favorite_set');
Route::post('api/information/set' , 'IotController@setinform')->middleware('auth')->name('inform_set');
Route::post('api/iot/specialrecord' , 'BeaconController@record')->middleware('auth')->name('beacon_record');
Route::post('api/setprofile' , 'BeaconController@setshop')->middleware('auth')->name('profile_set');
Route::post('api/beacon' , 'BeaconController@store')->middleware('auth')->name('beacon.store');
Route::post('/api/notif/{notif}/edit', 'IotController@editnotif');
Route::post('/api/notif/update', 'IotController@updatenotif')->name('notif_update');


////////////////////   post url resource /////////////////////
Route::post('api/beacon' , 'BeaconController@store')->middleware('auth')->name('beacon.store');
