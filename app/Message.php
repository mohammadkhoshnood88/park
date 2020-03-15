<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'shop_id',
        'user_id',
        'content',
        'type',
        'offer_percent',
        'pic',
        'favorite'
    ];

    public function shop_name()
    {
//        return $this->shop_id;
        $shop_name = Shop::all()->where('id' , '=' , $this->shop_id)->first();
        return $shop_name->shop_name;
    }
}
