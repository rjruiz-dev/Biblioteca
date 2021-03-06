<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = ['fine_description', 'operation'];

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

    public function variables()
    { 
        return $this->hasMany(Variables::class);
    }
}
