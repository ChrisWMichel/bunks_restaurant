<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedToppings extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function orderHistory(){
        return $this->belongsTo(OrderHistory::class);
    }
}
