<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adaptations extends Model
{
    protected $fillable = ['adaptation_name'];

    public function movie()
    {
        return $this->hasOne(Movies::class);
    }
}
