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

}
