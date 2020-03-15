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
        'type',
        'offer_percent'
    ];
    public function shop_name(){
//        return $this->user_id;
        $shop_name = Shop::where('user_id' , $this->user_id)->first();
        return $shop_name->shop_name;
    }
    public function shop_id(){
//        return $this->user_id;
        $shop_name = Shop::where('user_id' , $this->user_id)->first();
        return $shop_name->id;
    }

}
