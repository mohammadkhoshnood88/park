<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'shop_name',
        'logo',
        'add',
        'type',
        'groups',
        'race_title',
        'race_desc',
        'arr_time',
        'number',
        'st_time',
        'fin_time',
        'beacon_mac'
    ];
}
