<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{ 
    protected $fillable = ['documents_id', 'music_types_id', 'format', 'sound', 'gender', 'producer'];

    public function document()
    {
        return $this->belongsTo(Document::class);
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
}
