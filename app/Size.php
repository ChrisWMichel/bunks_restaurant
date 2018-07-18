<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];
    public $with = ['topping_cost'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function topping_cost(){
        return $this->hasOne(Topping_Cost::class);
    }
}
