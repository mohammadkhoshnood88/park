<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Customer extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'name',
        'mobile',
        'password',
        'getrace',
        'time',
        'points',
    ];
    protected $hidden = [
        'password' , 'rememberToken'
    ];

    public function message()
    {
        $messages = DB::table('follows')
            ->join('messages', 'follows.shop_name', '=', 'messages.shop_name')
            ->where(['follows.follow', true] , ['follows.mac_address' , $this->mac_address])
            ->select( 'messages.*' , 'follows.*')
            ->get();

        return $messages;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
