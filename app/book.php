<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['documents_id', 'generate_books_id', 'second_author_id', 'third_author_id', 'author', 
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

    public function second_author()
    {
        return $this->belongsTo(Creator::class, 'second_author_id');
    }

    public function third_author()
    {
        return $this->belongsTo(Creator::class, 'third_author_id');
    } 

    // public function periodical_publication()
    // {
    //     return $this->belongsTo(Periodical_publication::class, 'books_id');
    // } 
}
