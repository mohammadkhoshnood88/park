<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Customer;
use App\Iot;
use App\Notif;
use App\Race;
use App\Shop;
use Carbon\CarbonTimeZone;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeaconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beacons = Beacon::all();
        return view('setbeacon', compact('beacons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        Beacon::create([
            'uuid' => $request->get('uuid'),
            'mac_address' => $request->get('beacon_mac'),
            'major' => $request->get('major'),
            'minor' => $request->get('minor'),
            'location' => $request->get('location'),
            'group' => $request->get('group'),
            'nature' => $request->get('nature'),
            'tx' => '1'
        ]);
        Notif::create([
            'uuid' => $request->get('uuid'),
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

        $beacons = Beacon::where('uuid', $beacon)->get();
//        return $beacons;
        return view('editbeacon', compact('beacons'));
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

        DB::table('beacons')
            ->where(['uuid' => $beacon])
            ->update(['mac_address' => $request->get('beacon_mac')]);
        DB::table('beacons')
            ->where(['uuid' => $beacon])
            ->update(['tx' => $request->get('tx')]);
        DB::table('beacons')
            ->where(['uuid' => $beacon])
            ->update(['minor' => $request->get('minor')]);
        DB::table('beacons')
            ->where(['uuid' => $beacon])
            ->update(['major' => $request->get('major')]);
        if ($request->get('nature') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['nature' => $request->get('nature')]);
        }
        if ($request->get('nature') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['group' => $request->get('group')]);
        }
        if ($request->get('nature') != "انتخاب گزینه") {
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['location' => $request->get('location')]);
        }
        DB::table('beacons')
            ->where(['uuid' => $beacon])
            ->update(['uuid' => $request->get('uuid')]);
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
        Beacon::where('uuid', $beacon)->delete();
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
//                $iot = Iot::whereBetween();
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
        return view('profile');
    }

    public function setshop(Request $request)
    {
//        return $request;
//        $shop = new Shop();
//        $shop->add= "1";
//        $shop->name = $request->get('name');
//        $shop->shop_name = $request->get('shop_name');
//        $shop->logo = $request->get('logo');
//        $shop->type = $request->get('type');
//        $shop->groups = $request->get('groups');
//        $shop->race_title = $request->get('race_title');
//        $shop->race_desc = $request->get('race_desc');
//        $shop->arr_time = $request->get('arr_time');
//        $shop->number = $request->get('number');
//        $shop->st_time = $request->get('st_time');
//        $shop->fin_time = $request->get('fin_time');
//        $shop->save();
        Shop::create([
            'name' => $request->get('name'),
            'shop_name' => $request->get('shop_name'),
            'beacon_mac' => $request->get('beacon_mac'),
            'logo' => $request->get('logo'),
            'add' => $request->get('add'),
            'type' => $request->get('type'),
            'groups' => $request->get('groups'),
            'race_title' => $request->get('race_title'),
            'race_desc' => $request->get('race_desc'),
            'arr_time' => $request->get('arr_time'),
            'number' => $request->get('number'),
            'st_time' => '0',
            'fin_time' => '0'
        ]);
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
}
