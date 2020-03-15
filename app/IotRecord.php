<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IotRecord extends Model
{
    protected $fillable = ['beacon_id' , 'day_date' , 'record'];
}
