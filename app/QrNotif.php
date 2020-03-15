<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrNotif extends Model
{
    protected $fillable = ['qr_id' , 'user_id' , 'content' , 'group' , 'location'];

    public function get_pic()
    {
        $path = QrCode::where('id' , $this->qr_id)->first();
        return $path->path;
    }
}
