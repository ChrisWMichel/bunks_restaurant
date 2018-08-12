<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
