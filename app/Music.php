<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{ 
    protected $fillable = ['documents_id', 'generate_musics_id', 'generate_formats_id', 'sound', 'producer'];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    // public function music_type()
    // {
    //     return $this->belongsTo(Music_type::class);
    // }

    public function culture()
    { 
        return $this->hasOne(Culture::class);
    }

    public function popular()
    { 
        return $this->hasOne(Popular::class);
    }

    public function generate_music()
    {
        return $this->belongsTo(Generate_music::class, 'generate_musics_id');
    }

    public function generate_format()
    {
        return $this->belongsTo(Generate_format::class, 'generate_formats_id');
    }
}

