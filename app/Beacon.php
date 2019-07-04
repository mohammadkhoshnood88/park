<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static where(string $string)
 */
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
        'nature',
        'user_id',
        'shop_name'
    ];

    public function customers()
    {
        $users = DB::table('iots')
            ->join('customers', 'iots.customer_id', '=', 'customers.mac_address')
            ->where('iots.beacon_id', $this->uuid)
            ->select( 'customers.*' , 'iots.*')
            ->get();

        return $users;
    }
    public function notifs()
    {
        $users = DB::table('notifs')
            ->join('beacons', 'notifs.uuid', '=', 'beacons.uuid')
            ->where('notifs.uuid', $this->uuid)
            ->select( 'notifs.*' , 'beacons.*')
            ->get();

        return $users;
    }

}
