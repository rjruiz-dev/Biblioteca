<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia_type extends Model
{
    protected $fillable = ['multimedia_description'];

    public function multimedia()
    {
        return $this->hasMany(Multimedia::class);
    }
}
