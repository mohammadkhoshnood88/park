<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    public function notes()
    {
        return $this->belongsToMany(tag::class);
    }
}
