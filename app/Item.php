<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    public $with = ['prices'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function prices(){
        return $this->hasMany(Price::class);
    }
    public function orderHistorys(){
        return $this->hasMany(OrderHistory::class);
    }

    public static function randNum(){
        return str_random(10);
    }
}
