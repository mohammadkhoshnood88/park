<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = [
        'mac_address',
        'user_id',
        'beacon_mac',
        'type'


    ];

    public function message()
    {
        $users = DB::table('shops')
            ->join('races', 'shops.uuid', '=', 'races.uuid')
            ->where('notifs.uuid', $this->uuid)
            ->select( 'notifs.*' , 'beacons.*')
            ->get();

        return $users;
    }

}
