<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $guarded = [];
    protected $with =['item', 'ordered_toppings'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function ordered_toppings(){
        return $this->hasMany(OrderedToppings::class);
    }


}
