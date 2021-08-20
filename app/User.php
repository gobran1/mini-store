<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    //
    use \Illuminate\Auth\Authenticatable;

    protected $fillable=[
        'name','email','password',
    ];

    protected $hidden=[
        'password',
    ];


    public function orders(){
        return $this->hasMany('App\Order');
    }


}
