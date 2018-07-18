<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping_Cost extends Model
{
    protected $fillable = ['size_id', 'cost'];
    public $timestamps = false;

    /*public function size(){
        return $this->belongsTo(Size::class);
    }*/
}
