<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $guarded = [];
    public $with = ['size'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function size(){
        return $this->hasMany(Size::class);
    }
}
