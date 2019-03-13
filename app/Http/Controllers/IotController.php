<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Notif;
use App\Customer;
use App\Http\Resources\iotresource;
use App\iot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\InputOption;
use function Symfony\Component\Console\Tests\Command\createClosure;

class IotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $beacon_iot = DB::table('iots')
            ->join('beacons', 'iots.beacon_mac', '=', 'beacons.mac_address')
            ->select('beacons.*', 'iots.count')
            ->get();

        $iot = Iot::all();

        $beacons = Beacon::all();
        $customer = Customer::all();
        $spiot = "";
        return view('tables', compact('iot', 'beacons', 'customer' , 'beacon_iot' , 'spiot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::where('mac_address', $request->get('mac_address'))->first();
        if (!$customer) {
            $customers = new Customer();
//            $customers->mac_address = $request->get('mac_address');
             Customer::create([
                'mac_address' => $request->get('mac_address')
            ]);
        }

        $iots = Iot::where(['beacon_mac'=> $request->get('beacon_mac') , 'customer_id'=> $request->get('mac_address')])->first();
        $beacon = Beacon::where('mac_address', $request->get('beacon_mac'))->first();

        if ($beacon && !$iots) {
            iot::create([
                'customer_id' => $request->get('mac_address'),
                'beacon_mac' => $request->get('beacon_mac'),
                'beacon_id' => $request->get('uuid'),
                'rssi' => $request->get('rssi'),
                'count' => '1'
            ]);

//            $iot = new Iot();
//            $iot->customer_id =  $request->get('mac_address');
//            $iot->beacon_mac = $request->get('beacon_mac');
//            $iot->beacon_id = $request->get('uuid');
//            $iot->rssi = $request->get('rssi');
//            $iot->count = '1';
//            $iot->save();

        }
        elseif ($beacon && $iots){

            DB::table('iots')
                ->where(['beacon_mac'=> $request->get('beacon_mac') , 'customer_id'=> $request->get('mac_address')])
                ->increment('count');
            DB::table('iots')
                ->where(['beacon_mac'=> $request->get('beacon_mac') , 'customer_id'=> $request->get('mac_address')])
                ->update(['rssi' => $request->get('rssi')]);
        }
        return "hello" . $request->get('beacon_mac');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function show(iot $iot)
    {
        return $iot;
        return $iot->Beacon()->get();
//        return iot::latest()->take(50)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function edit(iot $iot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, iot $iot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function destroy(iot $iot)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function notif()
    {
        $beacons = DB::table('notifs')
            ->join('beacons', 'notifs.uuid', '=', 'beacons.uuid')
            ->select('beacons.*', 'notifs.*')
            ->get();
$beacons = Beacon::all();

        return view('notif' , compact('beacons'));
    }

    public function inform()
    {
        return view('information');
    }

    public function setinform(Request $request)
    {

    }

    public function editnotif($notif,Request $request)
    {

    }
}
