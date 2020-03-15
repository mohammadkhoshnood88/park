<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = ['qr_code' , 'user_id' , 'path'];
}
