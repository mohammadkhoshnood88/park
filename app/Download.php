<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['download_apk' , 'download_ios' , 'beacon_buy'];
}
