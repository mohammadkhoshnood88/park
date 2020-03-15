<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Iot extends Model
{
    protected $fillable = [
    'beacon_id',
    'customer_id',
    'rssi',
    'count'
     ];

}
