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
}

