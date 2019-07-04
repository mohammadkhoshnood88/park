<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Customer;
use App\Favorite;
use App\Follow;
use App\Information;
use App\Iot;
use App\Message;
use App\Notif;
use App\Race;
use App\Shop;
use Carbon\CarbonTimeZone;
//use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            return "salam";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $information = Information::where('user_id', Auth::user()->id)->get();

        if (count($information) != 0) {
            $groups = unserialize($information[0]->groups);
            $natures = unserialize($information[0]->natures);
            $locations = unserialize($information[0]->locations);
        } else {
            $groups = [];
            $natures = [];
            $locations = [];
        }
        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
        return view('setbeacon', compact('beacons', 'groups', 'natures', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return Auth::user()->id;
        $shop = Shop::all()->where('user_id' , '=' , Auth::user()->id)->first();
        $shop_name = $shop->shop_name;
        Beacon::create([
            'uuid' => $request->get('uuid'),
            'shop_name' => $shop_name,
            'user_id' => Auth::user()->id,
            'name' => $request->get('name'),
            'mac_address' => $request->get('beacon_mac'),
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'location' => $request->get('location'),
            'group' => $request->get('group'),
            'nature' => $request->get('nature'),
            'tx' => '1'
        ]);
        Notif::create([
            'beacon_mac' => $request->get('beacon_mac'),
            'user_id' => Auth::user()->id,
            'txt' => "تعیین نشده است",
            'pic' => "تعیین نشده است",
            'url' => "تعیین نشده است",
            'vid' => "تعیین نشده است"
        ]);
        return redirect('/api/beacon/create');
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
            $natures = unserialize($information[0]->natures);
            $locations = unserialize($information[0]->locations);
        } else {
            $groups = [];
            $natures = [];
            $locations = [];
        }
        $beacons = Beacon::where('mac_address', $beacon)->get();
//        return $beacons;
        return view('editbeacon', compact('beacons', 'groups', 'natures', 'locations'));
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
        if ($request->get('nature') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['mac_address' => $beacon])
                ->update(['nature' => $request->get('nature')]);
        }
        if ($request->get('nature') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['mac_address' => $beacon])
                ->update(['group' => $request->get('group')]);
        }
        if ($request->get('nature') != "انتخاب گزینه") {
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

        return redirect('/api/beacon/create');

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
        Notif::where('beacon_mac' , $beacon)->delete();
        return redirect('/api/beacon/create');
    }

    public function record(Request $request)
    {

        if ($request['uuid'] != "" || $request['customer_mac'] != "") {
            if ($request['uuid'] != "") {
                $uuid = $request['uuid'];
                $spiot = Iot::all()->where('beacon_id', $uuid);
                $iot = Iot::all();
                return view('tables', compact('spiot', 'iot'));
            }
            if ($request['customer_mac'] != "") {
                $uuid = $request['customer_mac'];
                $spiot = Iot::all()->where('customer_id', $uuid);
                $iot = Iot::all();
                return view('tables', compact('spiot', 'iot'));
            }
        } elseif ($request['prdate'] != "یک گزینه را انتخاب کنید" || $request['todate'] != "" || $request['fromdate'] != "") {
            if ($request['prdate'] != "یک گزینه را انتخاب کنید") {
                $uuid = $request['prdate'];
//                if ($uuid == "ssss") {
//
//                }

                $spiot = Iot::all()->where('beacon_id', $uuid);
                $iot = Iot::paginate(30);
//                return $uuid;
                return view('tables', compact('spiot', 'iot'));
            }
            if ($request['todate'] != "" && $request['fromdate'] != "") {
                return Iot::wheredate('created_at', ['$request[\'todate\']', '$request[\'fromdate\']']);


            }
        }
    }

    public function showshop()
    {
        return view('race');
    }

    public function setshop(Request $request)
    {
        $shop = Shop::where('user_id' , Auth::user()->id)->get();
//        return $shop;
        if (count($shop) == 0){
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = time() . $file->getClientOriginalName();
            $file->move('logo/phptos', $filename);
            $logo = "/logo/photos/{$filename}";
        } else {
            $logo = "";
        }

        Shop::create([
            'name' => $request->get('name'),
            'shop_name' => $request->get('shop_name'),
            'user_id' => Auth::user()->id,
            'logo' => $logo,
            'address' => $request->get('address'),
            'type' => $request->get('type'),
            'tel_num' => $request->get('tel_num'),

        ]);
        }
        elseif (count($shop) == 1){
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['shop_name' => $request->get('shop_name')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['name' => $request->get('name')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['address' => $request->get('address')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['type' => $request->get('type')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['tel_num' => $request->get('tel_num')]);
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['shop_name' => $request->get('shop_name')]);
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = time() . $file->getClientOriginalName();
                $file->move('logo/phptos', $filename);
                $logo = "/logo/photos/{$filename}";
            } else {
                $logo = "";
            }
            DB::table('shops')
                ->where(['user_id' => Auth::user()->id])
                ->update(['logo' => $logo]);
        }
        return redirect('/');
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
        }
        elseif ($count->number == 0) {
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

    public function followpost(Request $request)
    {
        $customer = Follow::where(['mac_address' => $request->get('mac_address') , 'shop_name' => $request->get('shop_name')])
            ->get();
        if (count($customer) == 0) {

            Follow::create([
                'mac_address' => $request->get('mac_address'),
                'shop_name' => $request->get('shop_name'),
                'follow' => $request->get('follow')
            ]);

            return "aaaaa";
        }
        return response('following');
    }
    /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
//////////////////////////////////// inja barressi shavad////////////////////////////////
    public function get_home_message(Request $request)
    {
//        return $request;
        $message_follows = DB::table('messages')
            ->join('follows', 'messages.shop_name', '=', 'follows.shop_name')
            ->select('messages.*', 'follows.*')
            ->where(['mac_address' => $request->get('mac_address') , 'type' => 'special'])
            ->get();
        return $message_follows;
    }

    public function get_message(Request $request)
    {
        $message_general = Message::where(
            ['favorite'=> $request->get('favorite'),
            'type' => 'general'])
            ->get();

        return $message_general;

    }

    public function setfavorite(Request $request)
    {
//    return $request;
        $file = $request->file('favoritefile');
        $filename = time() . $file->getClientOriginalName();
        $file->move('favorites/phptos', $filename);
        Favorite::create([
            'favorite' => $request->get('favorite'),
            'path' => "/favorites/photos/{$filename}"
        ]);
        $favorites = Favorite::all();
        return view('information', compact('favorites'));
    }

    public function get_favorite()
    {
        $favorite = Favorite::all();
        return $favorite;
    }

    public function message_create(Request $request)
    {
        $file = $request->file('file');
        $filename = time() . $file->getClientOriginalName();
        $file->move('messages/phptos', $filename);
        $shop_name = Shop::all()->where('user_id', '=', Auth::user()->id);
//        return $shop_name;
        Message::create([
            'content' => $request->get('content'),
            'favorite' => $request->get('favorite'),
            'type' => "special",
            'pic' => "/messages/photos/$filename",
            'user_id' => Auth::user()->id,
            'shop_name' => $shop_name[0]->shop_name ?? "فروشگاه"
        ]);
        $messages = Message::all()->where('user_id', '=', Auth::user()->id);
        $favorites = Favorite::all();
        return view('message_shop', compact('messages' , 'favorites'));
    }

    /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
//////////////////////////////////// inja barressi shavad///////////////////////

    public function get_home_message_shopmessage(Request $request)
    {
        $shop_message = Message::all()->where('shopname' , '=' , $request->get('shop_name'));
        return $shop_message;
    }
    public function get_home_message_shopmessage_message(Request $request)
    {
        $shop_message = Message::all()->where('id' , '=' , $request->get('id'));
        return $shop_message;
    }
}
