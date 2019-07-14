<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'shop_name',
        'user_id',
        'content',
        'type',
        'pic',
        'favorite'
    ];
}
