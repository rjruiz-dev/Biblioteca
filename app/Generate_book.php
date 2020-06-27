<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generate_book extends Model
{
    protected $fillable = ['genre_book'];   

    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
