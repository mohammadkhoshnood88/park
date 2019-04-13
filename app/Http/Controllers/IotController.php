<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Customer;
use App\iot;
use App\Notif;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IotController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->only('inform');
    }
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

        $iot = Iot::paginate(30);

        $beacons = Beacon::all();
        $customer = Customer::all();
        $spiot = "";
        return view('tables', compact('iot', 'beacons', 'customer', 'beacon_iot', 'spiot'));
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
//return ;
        $customer = Customer::where('mac_address', $request->get('mac_address'))->first();
        if (!$customer) {
            $customers = new Customer();
            Customer::create([
                'mac_address' => $request->get('mac_address'),
                'name' => "name",
                'telnum' => "telnum",
                'getrace'=> "getrace",
                'time'=>"time",
                'points'=>"0"
            ]);
        }

        $iots = Iot::where(['beacon_mac' => $request->get('beacon_mac'), 'customer_id' => $request->get('mac_address')])->first();
        $beacon = Beacon::where('mac_address', $request->get('beacon_mac'))->first();

        $iot = new Iot();
        $iot->customer_id = $request->get('mac_address');
        $iot->beacon_mac = $request->get('beacon_mac');
        $iot->beacon_id = $request->get('uuid');
        $iot->rssi = $request->get('rssi');
        $iot->count = '1';
        $iot->save();

        return response()->json("hello" . $request->get('beacon_mac'));

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
        $notifs = Notif::all();
        return view('notif', compact('notifs'));
    }

    public function editnotif($notif, Request $request)
    {

        $notifs = Notif::where('uuid', $notif)->first();

        return view('editnotif', compact('notifs'));
    }

    public function updatenotif(Request $request)
    {

        if ($request->txt != "") {
            DB::table('notifs')
                ->where(['uuid' => $request->uuid])
                ->update(['txt' => $request->get('txt')]);
        }
        if ($request->pic != "") {
            DB::table('notifs')
                ->where(['uuid' => $request->uuid])
                ->update(['pic' => $request->get('pic')]);
        }
        if ($request->vid != "") {
            DB::table('notifs')
                ->where(['uuid' => $request->uuid])
                ->update(['vid' => $request->get('vid')]);
        }
        if ($request->url != "") {
            DB::table('notifs')
                ->where(['uuid' => $request->uuid])
                ->update(['url' => $request->get('url')]);
        }
        if ($request->dis != "") {
            DB::table('notifs')
                ->where(['uuid' => $request->uuid])
                ->update(['dis' => $request->get('dis')]);
        }

        return redirect('api/notif/create');
    }

    public function inform()
    {
        $beacons = Beacon::all();
//        return $beacons;
        return view('information', compact('beacons'));
    }

    public function setinform(Request $request)
    {

        $location=$request->locationlist;
        $location = substr($location,1);
        $location = explode("+",$location);

        $nature = $request->naturelist;
        $nature = substr($nature,1);
        $nature = explode("+",$nature);

        $group = $request->grouplist;
        $group = substr($group,1);
        $group = explode("+",$group);
        $information = array();
        $information = [$group , $nature , $location];
        return $information;
    }
}
