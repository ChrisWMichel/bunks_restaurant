<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    public $with = ['prices', 'orderHistorys'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function prices(){
        return $this->hasMany(Price::class);
    }

    public static function randNum(){
        return str_random(10);
    }
}
