<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Beacon extends Model
{
    protected $fillable = [
        'uuid',
        'minor',
        'name',
        'major',
        'tx',
        'location',
        'mac_address',
        'group',
        'user_id',
        'shop_id'
    ];

    public function customers()
    {

        $users = DB::table('iots')
            ->join('customers', 'iots.customer_id', '=', 'customers.mac_address')
            ->where('iots.beacon_mac', $this->mac_address)
            ->select('customers.*', 'iots.*')
            ->get();

        return $users;
    }

    public function counter()
    {
        $count = 0;
        $counters = Iot::where('iots.beacon_mac', $this->mac_address)->get();
        foreach ($counters as $counter) {
            $count += $counter->count;
        }

        return $count;
    }

    public function notifs()
    {
        $users = DB::table('notifs')
            ->join('beacons', 'notifs.uuid', '=', 'beacons.uuid')
            ->where('notifs.uuid', $this->uuid)
            ->select('notifs.*', 'beacons.*')
            ->get();

        return $users;
    }

    public function shop_name()
    {
//        return $this->shop_id;
        $shop_name = Shop::all()->where('id' , '=' , $this->shop_id)->first();
        return $shop_name->shop_name;
    }

    public function daily_record()
    {
        $record = IotRecord::all()->where('beacon_id' , '=' , $this->mac_address)->first();
        return $record;
    }
}
