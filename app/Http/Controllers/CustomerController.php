<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\customer;
use App\Http\Resources\customerresource;
use App\iot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param iot $iot
     * @return void
     */
    public function index(iot $iot)
    {
       return view('notif');


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
//        return $image;
        return response()->json(['success'=>$imageName]);

//        $imageUpload = new ImageUpload();
//        $imageUpload->filename = $imageName;
//        $imageUpload->save();
//        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }

    public function record(Request $request)
    {
        $record = DB::table('customers')
            ->join('races', 'customers.mac_address', '=', 'races.mac_address')
            ->select('races.*', 'customers.points')
            ->get();

        return $record->where('mac_address' , '=' , $request->mac_address);

    }
}
