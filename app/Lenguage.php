<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lenguage extends Model
{
    protected $fillable = ['lenguage_description'];

    public function lenguages()
    {
        return $this->hasMany(Lenguage::class);
    } 
}
