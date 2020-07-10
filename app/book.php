<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['documents_id', 'generate_books_id', 'author', 
    'subtitle', 'second_author', 'third_author', 'translator', 'edition', 
    'size'];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    public function generate_book()
    {
        return $this->belongsTo(Generate_book::class, 'generate_books_id');
    }
  
    public function periodical_publication()
    {
        return $this->hasOne(Periodical_publication::class, 'books_id');
    }

    // public function periodical_publication()
    // {
    //     return $this->belongsTo(Periodical_publication::class, 'books_id');
    // } 
}
