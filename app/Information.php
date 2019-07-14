<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
        'groups',
        'locations',
        'user_id',
        'shop_name'
        ];
}
