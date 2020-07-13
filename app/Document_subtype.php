<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_subtype extends Model
{
    protected $fillable = ['document_types_id', 'subtype_name'];

    // public function document_type()
    // {
    //     return $this->belongsTo(Document_type::class);
    // }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
  
}
