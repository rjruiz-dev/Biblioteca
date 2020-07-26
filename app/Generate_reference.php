<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_reference extends Model
{
    protected $fillable = ['reference_description'];   

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function documents()
    {        
        return $this->belongsToMany('App\Generate_reference', 'document_generate_reference', 'document_id', 'generate_reference_id');  
    }
}

