<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $guarded = [];
    //protected $with = ['items'];

    public function order(){
        return $this->belongsTo(Order::class);
    }


}
