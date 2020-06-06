<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement_type extends Model
{
    protected $fillable = ['description_movement', 'book_status'];

    public function book_movements()
    {
        return $this->hasMany(Book_movement::class);
    } 
}
