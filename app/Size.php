<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
