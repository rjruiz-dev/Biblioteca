<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_format extends Model
{
    protected $fillable = ['genre_format'];   

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }

    public function music()
    {
        return $this->hasOne(Music::class);
    }

    public function photography()
    {
        return $this->hasOne(Photography::class);
    }
}
