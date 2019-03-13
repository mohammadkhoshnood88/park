<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Iot extends Model
{
    protected $fillable = [
        'beacon_id',
        'customer_id',
        'rssi',
        'count',
        'beacon_mac'
     ];
}
