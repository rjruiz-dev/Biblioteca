<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photography extends Model
{
    protected $fillable = ['documents_id', 'type_photographies_id', 'subtitle',
     'author', 'second_author', 'third_author', 'producer', 'edition', 'format'];
    
     public function document()
     {
         return $this->belongsTo(Document::class);
     }
    
     public function type_photography()
    {
        return $this->belongsTo(Type_photography::class);
    }
}
