<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_movie extends Model
{
    protected $fillable = ['genre_movie'];   

    public function movie()
    {
        return $this->hasOne(Movies::class); 
    }
}
