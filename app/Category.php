<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];
    public $with = ['items'];

    public function items(){
        return $this->hasMany(Item::class);
    }
}
