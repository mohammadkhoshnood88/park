<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable=[
        'shop_name',
        'mac_address',
        'follow'
    ];
}
