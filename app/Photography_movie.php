<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photography_movie extends Model
{
    protected $fillable = ['photography_movies_name'];   

    public function movie()
    {
        return $this->hasOne(Movies::class); 
    }
}
