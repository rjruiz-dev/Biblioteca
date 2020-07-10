<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_film extends Model
{
    protected $fillable = ['genre_film'];   

    public function movie()
    {
        return $this->hasOne(Movie::class);
    }
}
