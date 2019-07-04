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

    public function message()
    {
        $messages = DB::table('follows')
            ->join('messages', 'follows.shop_name', '=', 'messages.shop_name')
            ->where(['follows.follow', true] , ['follows.mac_address' , $this->mac_address])
            ->select( 'messages.*' , 'follows.*')
            ->get();

        return $messages;
    }
}
