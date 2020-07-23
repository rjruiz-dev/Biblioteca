<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{    
    protected $fillable = ['actor_name'];

    public function movies()
    {        
        return $this->belongsToMany('App\Actor', 'actor_movie', 'movie_id', 'actor_id'); 
    }
}
