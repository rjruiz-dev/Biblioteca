<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_type extends Model
{
    protected $fillable = ['music_description'];

    public function book_type()
    {
        return $this->hasOne(Book_type::class);
    }
    
}
