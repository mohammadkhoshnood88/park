<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public function notes()
    {
        return $this->belongsToMany(note::class);
    }
}
