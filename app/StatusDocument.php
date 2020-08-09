<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusDocument extends Model
{
    protected $fillable = ['name_status'];

    public function documents()
    {
       return $this->hasMany(Document::class);
    }
}
