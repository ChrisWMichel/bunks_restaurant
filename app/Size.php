<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];
    public $with = ['toppingCost'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function toppingCost(){
        return $this->belongsTo(Topping_Cost::class);
    }
}
