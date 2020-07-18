<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodical_publication extends Model
{
    protected $fillable = ['books_id','periodicities_id','volume_number_date','issn'];

    // public function libro()
    // {
    //     return $this->hasOne(Book::class);
    // }
    
    public function libro()
    {
        return $this->belongsTo(Book::class, 'books_id');
    } 

    public function periodicidad()
    {
        return $this->belongsTo(Periodicity::class, 'periodicities_id');
    } 
}