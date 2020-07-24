<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = ['reference_description'];   

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function documents()
    {        
        return $this->belongsToMany('App\Document', 'document_reference', 'document_id', 'reference_id'); 
    }
}