<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping_Item extends Model
{
    protected $fillable = ['topping_cat_id', 'item'];

    public function topping_cat(){
        return $this->belongsTo(Topping_Cat::class);
    }
}
