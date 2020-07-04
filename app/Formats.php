<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formats extends Model
{
    protected $fillable = ['format_name'];

    public function music()
    {
        return $this->hasMany(Music::class);
    }
    public function multimedia()
    {
        return $this->hasMany(Multimedia::class);
    }
    public function movie()
    {
        return $this->hasMany(Movies::class);
    }
}
