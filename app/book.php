<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['documents_id', 'book_types', 'genders_id', 'author', 
    'subtitle', 'second_author', 'third_author', 'translator', 'edition', 
    'size'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function book_type()
    {
        return $this->belongsTo(Book_type::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    
    public function periodical_publication()
    {
        return $this->hasOne(Periodical_publication::class);
    }
}
