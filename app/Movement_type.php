<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement_type extends Model
{
    protected $fillable = ['description_movement', 'book_status_public', 'book_status_priv', 'view', 'orden'];

    public function book_movements()
    {
        return $this->hasMany(Book_movement::class);
    } 

    public function copy()
    {
        return $this->hasMany(Copy::class);
    }
}
