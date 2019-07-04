<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $fillable = [
        'beacon_mac',
        'user_id',
        'txt',
        'url',
        'pic',
        'vid'
    ];
}
