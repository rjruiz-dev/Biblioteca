<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = ['documents_id', 'second_author_id', 'third_author_id',
    'subtitle', 'isbn', 'edition', 'translator'
    ,'size'];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    public function second_author()
    {
        return $this->belongsTo(Creators::class, 'second_author_id');
    }

    public function third_author()
    {
        return $this->belongsTo(Creators::class, 'third_author_id');
    } 
}
 
