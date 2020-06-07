<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = ['documents_id', 'multimedia_types_id', 'author',
    'subtitle', 'second_author', 'third_author', 'isbn', 'gender', 'edition'
    ,'size','edition'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function multimedia_type()
    {
        return $this->belongsTo(Multimedia_type::class);
    }
}
 
