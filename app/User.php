<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, \Awobaz\Compoships\Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country', 'city', 'money', 'currency_id'
    ];

    public function getReceivedAttribute($value) {
        return round($value, 2);
    }

    public function getForwardedAttribute($value) {
        return round($value, 2);
    }

    public function getBalanceAttribute($value) {
        return round($value, 2);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function operations()
    {
        return $this->hasMany('App\Operation', 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function forwards()
    {
        return $this->hasMany('App\Operation', 'recipient_id', 'id')->orderBy('created_at', 'desc');
    }


    public function currency()
    {
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }
}
