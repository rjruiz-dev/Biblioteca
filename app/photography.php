<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photography extends Model
{
    protected $fillable = ['documents_id', 'type_photographies_id', 'generate_formats_id', 'subtitle',
     'author', 'second_author', 'third_author', 'producer', 'edition'];
    
     public function document()
     {
         return $this->belongsTo(Document::class, 'documents_id');
     }
    
     public function type_photography()
    {
        return $this->belongsTo(Type_photography::class);
    }

    public function generate_format()
    {
        return $this->belongsTo(Generate_format::class, 'generate_formats_id');
    }
}
