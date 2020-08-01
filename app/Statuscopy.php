<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuscopy extends Model
{
    protected $fillable = ['name_status'];

    public function user()
    {
        return $this->hasOne(Copy::class);
    } 
}
