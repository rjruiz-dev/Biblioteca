<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_musics extends Model
{
    protected $fillable = ['genre_music'];   

    public function music()
    {
        return $this->hasOne(Music::class); 
    }
}
