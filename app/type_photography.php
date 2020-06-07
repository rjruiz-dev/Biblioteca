<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_photography extends Model
{
    protected $fillable = ['photography_description'];
    
     public function photographies()
    {
        return $this->hasMany(Photography::class);
    }
}
