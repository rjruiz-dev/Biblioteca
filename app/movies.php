<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['documents_id', 'generate_films_id', 'generate_formats_id', 'generate_subjects_id',  'adaptations_id', 'photography_movies_id', 'subtitle',  'distribution', 
    'script', 'specific_content', 'awards', 'distributor'];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    public function generate_movie()
    {
        return $this->belongsTo(Generate_film::class, 'generate_films_id');
    }

    public function generate_format()
    {
        return $this->belongsTo(Generate_format::class, 'generate_formats_id');
    }   
     

    public function adaptation()
    {
        return $this->belongsTo(Adaptations::class, 'adaptations_id');
    }

    public function photography_movie()
    {
        return $this->belongsTo(photography_movies::class, 'photography_movies_id');
    }
}
