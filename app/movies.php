<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['documents_id', 'generate_films_id', 'generate_formats_id', 'subtitle', 'director', 'distribution', 
    'original_title', 'script', 'specific_content', 'photography', 
    'awards', 'distributor'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function generate_movie()
    {
        return $this->belongsTo(Generate_film::class, 'generate_films_id');
    }

    public function generate_format()
    {
        return $this->belongsTo(Generate_format::class, 'generate_formats_id');
    }
}
