<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $fillable = [
        'mac_address',
        'beacon_mac',
        'type'


    ];

}
