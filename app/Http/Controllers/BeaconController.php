<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Iot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class BeaconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        $nam = Request.isset($_POST['nam']);
//            Beacon::create([
//                'uuid' => $nam[uuid],
//                'mac_address' => $nam[beacon_mac],
//                'major' => $nam[major],
//                'minor' => $nam[minor],
//                'location' => $nam[location],
//                'group' => $nam[group],
//                'nature' => $nam[nature],
//                'tx' => '1'
//            ]);

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
    public function update(Request $request,$beacon)
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
        if ($request->get('nature')!="انتخاب گزینه"){
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['nature' => $request->get('nature')]);}
        if ($request->get('nature')!="انتخاب گزینه"){
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['group' => $request->get('group')]);}
        if ($request->get('nature')!="انتخاب گزینه"){
            DB::table('beacons')
                ->where(['uuid' => $beacon])
                ->update(['location' => $request->get('location')]);}
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
        if ($request['uuid']!="" || $request['customer_mac']!=""){
            if ($request['uuid']!=""){
                $uuid = $request['uuid'];
                $spiot = Iot::all()->where('beacon_id' , $uuid);
                $iot = Iot::all();
                return view('tables' , compact('spiot' , 'iot'));
            }
            if ($request['customer_mac']!=""){
                $uuid = $request['customer_mac'];
                $spiot = Iot::all()->where('customer_id' , $uuid);
                $iot = Iot::all();
                return view('tables' , compact('spiot' , 'iot'));
            }
        }
        elseif ($request['prdate']!="یک گزینه را انتخاب کنید" || $request['todate']!="" || $request['fromdate']!=""){
            if ($request['prdate']!="یک گزینه را انتخاب کنید"){
                $uuid = $request['prdate'];
                if ($uuid == "ssss"){


                }

                $spiot = Iot::all()->where('beacon_id' , $uuid);
                $iot = Iot::all();
                return $uuid;
                return view('tables' , compact('spiot' , 'iot'));
            }

        }
    }
}
