<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adequacy extends Model
{
    protected $fillable = ['adecuacy_description'];

    public function documents()
    {
        return $this->hasMany(Document::class);
    } 
}
