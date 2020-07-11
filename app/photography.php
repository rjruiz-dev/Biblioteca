<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photography extends Model
{
    protected $fillable = ['documents_id', 'formats_id', 'second_author_id', 'third_author_id', 
    'subtitle', 'producer', 'edition'];
    
     public function document()
     {
         return $this->belongsTo(Document::class, 'documents_id');
     }
    
    public function format()
    {
        return $this->belongsTo(Formats::class, 'formats_id');
    }
}
