<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = ['description_genre_book'];

    public function libro()
    {
        return $this->hasOne(Book::class);
    }
}
