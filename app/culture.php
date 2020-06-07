<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $fillable = ['music_id', 'album_title', 'soloist', 'orchestra', 'director', 'composer'];

    public function music()
    {
        return $this->belongsTo(Music::class);
    }
}
