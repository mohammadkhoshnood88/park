<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'shop_name',
        'logo',
        'address',
        'plaque',
        'floor',
        'type',
        'tel_num',
        'shop_name'
    ];

    public function notif()
    {
        $notifs = DB::table('notifs')
            ->where('notifs.uuid', $this->uuid)
            ->select('notifs.*')
            ->get();

        return $notifs;
    }

    public function beacons()
    {
        $beacons = Beacon::where('user_id', $this->user_id)->get();
        return $beacons;
    }

    public function beacon_num()
    {
        $beacon_num = Beacon::all()->where('user_id', '=', $this->user_id)->count();
        return $beacon_num;

    }

    public function messages()
    {
        $beacons = Message::where('user_id', $this->user_id)->get();
        return $beacons;
    }

    public function message_num()
    {
        $message_num = Message::all()->where('user_id', '=', $this->user_id)->count();
        return $message_num;

    }

    public function qrcodes()
    {
        $beacons = QrNotif::where('user_id', $this->user_id)->get();
        return $beacons;
    }

    public function qrcode_num()
    {
        $qrcode_num = QrNotif::all()->where('user_id', '=', $this->user_id)->count();
        return $qrcode_num;

    }


}
