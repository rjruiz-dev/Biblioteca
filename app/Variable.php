<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $fillable = ['fines_id', 'variable_description', 'value'];

    public function fine() 
    {
        return $this->belongsTo(Fine::class);
    }
}
