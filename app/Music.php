<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{ 
    protected $fillable = ['documents_id', 'generate_musics_id', 'formats_id', 'sound', 'gender', 'producer'];

    public function document()
    {
        return $this->belongsTo(Document::class,'documents_id');
    }

    public function music_type()
    {
        return $this->belongsTo(Music_type::class);
    }

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
        return $this->belongsTo(Generate_musics::class, 'generate_musics_id');
    }
    public function format()
    {
        return $this->belongsTo(Formats::class, 'formats_id');
    }
}
