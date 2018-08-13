<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'active',  'email', 'password', 'role_id', 'email_token',
        'address', 'city', 'state', 'zipcode', 'phone'
    ];
    public $with = ['role', 'orders'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generateVerificationCode(){
        return str_random(40);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function isAdmin(){
        if($this->role->name == 'administrator'){
            return true;
        }else{
            return false;
        }
    }

    public function isEmployee(){
        if($this->role->name == 'employee'){
            return true;
        }else{
            return false;
        }
    }
}
