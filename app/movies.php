<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['documents_id', 'formats_id', 'generate_movies_id', 'adaptations_id', 'photography_movies_id',
    'subtitle', 'distribution', 'script', 'specific_content', 'awards', 'distributor'];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }
    public function format()
    {
        return $this->belongsTo(Formats::class, 'formats_id');
    }

    public function generate_movie()
    {
        return $this->belongsTo(Generate_movie::class, 'generate_movies_id');
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
