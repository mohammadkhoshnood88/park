<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Customer;
use App\Download;
use App\Favorite;
use App\Follow;
use App\Http\Requests\BeaconBuy;
use App\Http\Requests\FavoriteValidation;
use App\Information;
use App\Iot;
use App\IotRecord;
use App\Message;
use App\Notif;
use App\Race;
use App\Shop;
use App\User;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

//use function MongoDB\BSON\toJSON;

class BeaconController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Gate::denies('is-admin'));
        dd(Session::getName());
        return "done!";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user_information = Information::whereUserId(Auth::user()->id)->get();
//        return ;
        if (count($user_information) == 0){
            $groups = [];
            $locations = [];
        }
        else{
        $groups = unserialize($user_information[0]->groups);
        $locations = unserialize($user_information[0]->locations);
        if ($user_information[0]->groups == null) {
            $groups = [];
        } else if ($user_information[0]->locations == null) {
            $locations = [];
        }
        }
        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
        return view('setbeacon', compact('groups', 'locations', 'beacons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->beacon_mac;
        $this->validate($request ,
            [
                'name' => 'required|min:3|max:12|unique:beacons',
                'uuid' => 'required',
                "beacon_mac" => "required|array|min:6|max:6",
                "beacon_mac.*"  => "required|string|min:2",
            ],
            [
                'name.min' => 'برای نام حداقل 3 حرف وارد کنید',
                'name.max' => 'طول نام ورودی بیش از حد مجاز است',
                'name.unique' => 'این نام قبلا استفاده شده است',
                'beacon_mac.required' => 'مک آدرس را وارد کنید',
                'uuid.required' => 'uuid را وارد کنید',
                'beacon_mac.*.required' => 'مک آدرس وارد شده معتبر نیست',
                'beacon_mac.*.min' => 'مک آدرس وارد شده معتبر نیست',
                'beacon_mac.*.max' => 'مک آدرس وارد شده معتبر نیست',
            ]
        );

        $beacon_mac = $request->beacon_mac;
        $beacon_mac = "[" . $beacon_mac[0] . ":" .
         $beacon_mac[1] . ":" .
         $beacon_mac[2] . ":" .
         $beacon_mac[3] . ":" .
         $beacon_mac[4] . ":" .
         $beacon_mac[5] . "]";



        $shop = Shop::all()->where('user_id', '=', Auth::user()->id)->first();
//        return $shop;
        $shop_id = $shop->id;
        Beacon::create([
            'uuid' => $request->get('uuid'),
            'shop_id' => $shop_id,
            'user_id' => Auth::user()->id,
            'name' => $request->get('name'),
            'mac_address' => $beacon_mac,
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'location' => $request->get('location'),
            'group' => $request->get('group'),
            'tx' => '1'
        ]);
        IotRecord::create([
            'beacon_id' => $beacon_mac,
            'day_date' => Carbon::now(),
            'record' => "a"
        ]);
        Notif::create([
            'beacon_mac' => $beacon_mac,
            'user_id' => Auth::user()->id,
            'txt' => "تعیین نشده است",
            'pic' => "تعیین نشده است",
            'url' => "تعیین نشده است",
            'vid' => "تعیین نشده است"
        ]);

        session()->flash('beacon-message' , 'بیکن جدید اضافه شد');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beacon $beacon
     * @return \Illuminate\Http\Response
     */
    public function show(Beacon $beacon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beacon $beacon
     * @return \Illuminate\Http\Response
     */
    public function edit($beacon)
    {
        $information = Information::where('user_id', Auth::user()->id)->get();

        if (count($information) != 0) {
            $groups = unserialize($information[0]->groups);
            $locations = unserialize($information[0]->locations);
        } else {
            $groups = [];
            $locations = [];
        }
        $beacons = Beacon::where('mac_address', $beacon)->get();
//        return $beacons;
        return view('editbeacon', compact('beacons', 'groups', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Beacon $beacon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $beacon)
    {
//        $this->authorize('UserPark', $beacon);
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['name' => $request->get('name')]);
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['mac_address' => $request->get('beacon_mac')]);
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['tx' => $request->get('tx')]);
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['minor' => $request->get('minor')]);
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['major' => $request->get('major')]);

        if ($request->get('group') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['mac_address' => $beacon])
                ->update(['group' => $request->get('group')]);
        }
        if ($request->get('location') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['mac_address' => $beacon])
                ->update(['location' => $request->get('location')]);
        }
        DB::table('beacons')
            ->where(['mac_address' => $beacon])
            ->update(['uuid' => $request->get('uuid')]);

//        DB::table('beacons')
//            ->where(['uuid' => $beacon])
//            ->update(['user_id' => Auth::user()->id]);

        return redirect('/beacon/create');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beacon $beacon
     * @return \Illuminate\Http\Response
     */
    public function destroy($beacon)
    {
//        $this->authorize('UserPark', $beacon);

        Beacon::where('mac_address', $beacon)->delete();
        Notif::where('beacon_mac', $beacon)->delete();
        \Session::flash('beacon-message' , 'حذف بیکن با موفقیت انجام شد');

        return back();
    }

    public function setrace()
    {
        $beacons = Beacon::where('user_id' , Auth::user()->id)->get();
        $favorites = Favorite::all();
        return view('race' , compact('beacons' , 'favorites'));
    }

    public function racestatus()
    {
        return view('racestatus');
    }

    public function setshop(Request $request)
    {
        $shop = Shop::where('user_id', Auth::user()->id)->get();
//        return $shop;
        if (count($shop) == 0) {
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $file->move('logo/photos', $filename);
                $logo = "logo/photos/{$filename}";
            } else {
                $logo = "";
            }

            $shop = new Shop();
            $shop->name = $request->get('name');
            $shop->shop_name = $request->get('shop_name');
            $shop->user_id = Auth::user()->id;
            $shop->logo = $logo;
            $shop->tel_num = $request->get('tel_num');
            $shop->type = $request->get('type');
            if ($request->get('type') == "admin") {
                $shop->address = $request->get('address');
            } else {
                $shop->plaque = $request->get('plaque');
                $shop->floor = $request->get('floor');
            }
            $shop->save();

        } elseif (count($shop) == 1) {
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['shop_name' => $request->get('shop_name')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['name' => $request->get('name')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['type' => $request->get('type')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['tel_num' => $request->get('tel_num')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['shop_name' => $request->get('shop_name')]);
            if ($request->get('type') == "admin") {
                DB::table('shops')
                    ->where(['user_id' => Auth::user()->id])
                    ->update(['address' => $request->get('address')]);
            } else {
                DB::table('shops')
                    ->where(['user_id' => Auth::user()->id])
                    ->update(['plaque' => $request->get('plaque')]);
                DB::table('shops')
                    ->where(['user_id' => Auth::user()->id])
                    ->update(['floor' => $request->get('floor')]);
            }

            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $file->move('logo/photos', $filename);
                $logo = "/logo/photos/{$filename}";
            } else {
                $logo = "";
            }
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['logo' => $logo]);
        }
        DB::table('users')
            ->where(['id' => Auth::user()->id])
            ->update(['profile' => 1]);

        return redirect('/home');
    }

    public function getrace()
    {
        $now = Carbon::now();
        $now = $now->addHours(3)->addMinutes(30);
        $hn = $now->hour;
        $now2 = $now->addHours(1);
        $hnn = $now2->hour;
        $shops = DB::table('shops')
            ->join('beacons', 'shops.beacon_mac', '=', 'beacons.mac_address')
            ->select('beacons.uuid', 'shops.*')
            ->get();
        $i = 0;

        $shopgroup = array();
        foreach ($shops as $shop) {
            $st = explode(':', $shop->arr_time, 2);

            if ($hn <= $st[0] && $st[0] <= $hnn) {
                $shopgroup[$i] = $shop;
                $i++;
            }

        }


        return response()->json($shopgroup);
    }

    public function startrace(Request $request)
    {
        $count = Shop::where(['beacon_mac' => $request->get('beacon_mac'), 'type' => $request->get('type')])->first();
//        if ($count > 0) {
        if ($request->get('race') == 1 && $count->number > 0) {
            if (!Customer::where(['mac_address' => $request->get('mac_address')])->first()) {
                Customer::create([
                    'mac_address' => $request->get('mac_address'),
                    'name' => $request->get('name'),
                    'telnum' => $request->get('telnum'),
                    'getrace' => '0',
                    'time' => '0',
                    'points' => '0'
                ]);
            }

            Race::create([
                'mac_address' => $request->get('mac_address'),
                'beacon_mac' => $request->get('beacon_mac'),
                'type' => $request->get('type')
            ]);
            $shop = Shop::where(['type' => $request->get('type')])->first();
            $shop->number--;
//                return $shop->number;
            $shop->save();
            return response()->json('ok', 200);
        } elseif ($request->get('race') == 2) {

            $race = Race::where(['mac_address' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac'), 'type' => $request->get('type')])->first();
            $race_time = Carbon::parse($race->created_at);
            $now = Carbon::now();
            $aa = $now->diff($race_time)->format("%i");
            if ($aa > 10) {
                return response()->json('finishtime');
            } else {
                $arr_time = 10 - ($aa);
                $customer = Customer::where(['mac_address' => $request->get('mac_address')])->first();
                $customer->points = $customer->points + $arr_time;
                $customer->save();
            }
            return response()->json('ok', 200);
        } elseif ($request->get('race') == 3) {
            $race = Race::all()->where('mac_address', '=', $request->get('mac_address'))->first();
            $race_timee = Carbon::parse($race->updated_at);
            $now = Carbon::now();
            $ex_time = $now->diff($race_timee)->format("%i");
            $customer = Customer::all()->where('mac_address', '=', $request->get('mac_address'))->first();
            $customer->points = $customer->points + $ex_time;
            $customer->save();
        } elseif ($count->number == 0) {
            return response()->json('0', 400);
        }
//        }
//        else{return response()->json('0');}
    }

    public function cancelrace(Request $request)
    {
        Race::where(['mac_address' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac'), 'type' => $request->get('type')])->delete();
        $customer = Customer::where(['mac_address' => $request->get('mac_address')])->first();
        $customer->points = $customer->points - 3;
        $customer->save();
    }

//    public function followpost(Request $request)
//    {
////        return $request;
//        $customer = Follow::where(['mac_address' => $request->get('mac_address'), 'shop_id' => $request->get('shop_id')])
//            ->get();
//        if (count($customer) == 0) {
//
//            Follow::create([
//                'mac_address' => $request->get('mac_address'),
//                'shop_id' => $request->get('shop_id'),
//                'follow' => $request->get('follow')
//            ]);
//
//            return "aaaaa";
//        }
//        return response('following');
//    }



    public function get_home_message(Request $request)
    {
//        return $request;
        $message_follows = DB::table('messages')
            ->join('follows', 'messages.shop_id', '=', 'follows.shop_id')
            ->join('shops', 'shops.id', '=', 'follows.shop_id')
            ->select('messages.*', 'follows.*' , 'shops.shop_name')
            ->where('mac_address', '=', $request->get('mac_address'))
            ->get();
        return $message_follows;
    }

    public function get_message(Request $request)
    {
        $messages = Message::where('favorite', $request->get('favorite'))
            ->get();

        return $messages;
    }

    /**
     * @param FavoriteValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setfavorite(FavoriteValidation $request)
    {
//        return $request;
        $file = $request->file('favoritefile');
        $filename = time() . $file->getClientOriginalName();
        $file->move('favorites/photos', $filename);
        Favorite::create([
            'favorite' => $request->get('favorite'),
            'path' => "favorites/photos/{$filename}"
        ]);
        $favorites = Favorite::all();
        $text = "";
        return back();
    }

    public function get_favorite()
    {
        $favorite = Favorite::all();
        return $favorite;
    }

    public function message_create(Request $request)
    {
        $shop = Shop::where('user_id', '=', Auth::user()->id)->first();
        $shop_id = $shop->id;
        $file = $request->file('file');
        $filename = time() . $file->getClientOriginalName();
        $file->move('messages/photos', $filename);

        $message = new Message();
        $message->content = $request->get('content');
        $message->favorite = "";
        $message->pic = "messages/photos/$filename";
        $message->user_id = Auth::user()->id;
        $message->shop_id = $shop_id ?? '-1';
        if ($request->get('offer_set') == 0) {
            $message->type = "special";

        } elseif ($request->get('offer_set') == 1) {
            $message->type = 1;
            $message->offer_percent = $request->get('offer_percent');
        }
        $message->save();

//        $messages = Message::all()->where('user_id', '=', Auth::user()->id);
//        $favorites = Favorite::all();
        return back();
    }


    public function get_home_message_shopmessage(Request $request)
    {
        $shop_message = Message::all()->where('shop_id', '=', $request->get('shop_id'));
        return $shop_message;
    }

    public function get_home_message_shopmessage_message(Request $request)
    {
        $shop_message = Message::all()->where('id', '=', $request->get('id'));
        return $shop_message;
    }

    public function all_shop_beacons()
    {
        $admin = User::where('isadmin', '=', '1')->first();
        $shops = Shop::all();
        $admin_shop = Shop::all()->where('user_id', '=', $admin->id);
//        return $shops[0]->beacons();
        $admin_shop = $admin_shop[0]->shop_name;
        return view('all_shop_beacons', compact('shops', 'admin_shop'));
    }

    public function beacon_status_change(Request $request)
    {
//        return ;
        $beacon = Beacon::all()->where('mac_address' , '=', $request->get('mac_address'))->first();
        $status = $beacon->status;
        if ($status == 1){
            $new_status = 0;
        }else{$new_status = 1;}
        DB::table('beacons')
            ->where(['mac_address' => $request->get('mac_address')])
            ->update(['status' => $new_status]);
        return response()->json(['success' => true, 'mac_address' => $request->get('mac_address') , 'new_status' => $new_status]);
    }

    public function download_apk()
    {
        DB::table('downloads')->
        where('id' , '=' , 1)->
        increment('download_apk');

        return response()->download(storage_path('app/PaceSpace.apk'));
    }

    public function beacon_buy()
    {
        return view('buy-beacon');
    }

    public function beacon_set_price(Request $request)
    {
        if ($request->get('number') > 25) {
            return response()->json(['success' => false, 'message' => 'تعداد بیکن درخواستی بیشتر از حد مجاز است.']);
        }
        $price = $request->get('number') * 75000;

        DB::table('downloads')->
        where('id' , '=' , 1)->
        increment('beacon_buy');

        return response()->json(['success' => true, 'beacon_price' => '75000', 'price' => $price]);
    }

    /**
     * @param BeaconBuy $request
     */
    public function customer_buy_beacon(BeaconBuy $request)
    {
        return $request;
    }
}
