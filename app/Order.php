<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public $with = ['orderHistories'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderHistories(){
        return $this->hasMany(OrderHistory::class);
    }
}
