<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public $with = ['orderHistorys'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderHistorys(){
        return $this->hasMany(OrderHistory::class);
    }
}
