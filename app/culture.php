<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $fillable = ['music_id', 'album_title', 'director', 'orchestra', 'soloist'];

    public function music()
    {
        return $this->belongsTo(Music::class);
    }
}
