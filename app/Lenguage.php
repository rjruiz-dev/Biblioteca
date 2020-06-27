<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lenguage extends Model
{
    protected $fillable = ['lenguage_description'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    } 
}
