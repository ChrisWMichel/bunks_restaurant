<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping_Cat extends Model
{
    protected $fillable = ['name'];
    public $with = ['topping_items'];

    public function topping_items(){
        return $this->hasMany(Topping_Item::class);
    }
}
