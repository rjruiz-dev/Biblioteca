<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{ 
    protected $fillable = ['document_description'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    } 

    public function creators()
    {
        return $this->hasMany(Creator::class);
    } 

    public function document_subtypes()
    {
        return $this->hasMany(Document_subtype::class);
    } 
}
