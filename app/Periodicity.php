<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodicity extends Model
{
    protected $fillable = ['periodicity_name'];
    
    public function periodicidades()
    {
        return $this->hasMany(Periodical_publication::class);
    } 
}
