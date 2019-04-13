<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'telnum',
        'mac_address',
        'getrace',
        'time',
        'points',
    ];
}
