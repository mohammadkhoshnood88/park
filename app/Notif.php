<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $fillable = [
      'uuid',
        'txt',
        'url',
        'pic',
        'vid'
    ];
}
