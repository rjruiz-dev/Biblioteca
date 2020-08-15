<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{
    protected $fillable = ['music_id', 'album_title', 'subtitle', 'artist', 
    'other_artists', 'music_populars'];
    
    public function music()
    {
        return $this->belongsTo(Music::class);
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class, 'other_artists'); 
    }
}
