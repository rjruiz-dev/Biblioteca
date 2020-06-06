<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_type extends Model
{
    protected $fillable = ['music_description'];

    public function musics()
    {
        return $this->hasMany(Music::class);
    } 
}
