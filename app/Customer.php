<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
      'name',
      'mac_address'
    ];
    public function Beacon()
    {
//        return Beacon::where()->get();
//        return Beacon::where()->where();
        return $this->belongsToMany(Iot::class)->using('App\Iot')->withTimestamps;
    }
}
