<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id' , 'comment' , 'answer' , 'answer_status'];

    public function user_name()
    {
        $user_name = User::all()->where('id' , '=' , $this->user_id)->first();
        return $user_name->name;
    }
}
