<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document_type extends Model
{
    protected $fillable = ['document_description'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    } 
}
