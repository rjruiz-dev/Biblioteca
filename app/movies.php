<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = ['documents_id', 'subtitle', 'director', 'distribution', 
    'original_title', 'script', 'specific_content', 'gender', 'photography', 
    'awards', 'distributor', 'format'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
