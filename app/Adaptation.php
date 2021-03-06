<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adaptation extends Model
{
    protected $fillable = ['adaptation_name'];

    public function movie()
    {
        return $this->hasOne(Movies::class);
    }
}
