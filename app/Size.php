<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];
    public $with = ['topping_cost'];

    public function topping_cost(){
        return $this->hasOne(Topping_Cost::class);
    }

    public function price(){
        return $this->belongsTo(Price::class);
    }
}
