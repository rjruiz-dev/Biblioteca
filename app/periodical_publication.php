<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodical_publication extends Model
{
    protected $fillable = ['books_id','volume_number_date','ISSN','periodicity'];

    public function libro()
    {
        return $this->belongsTo(Book::class);
    } 
}
