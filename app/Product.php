<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'url','title','description','price',
    ];

    public function getUrlAttribute($value){
        return asset($value);
    }

}
