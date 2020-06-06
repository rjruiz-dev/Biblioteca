<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_name'];

    public function book_movements()
    {
        return $this->hasMany(Book_movement::class);
    } 
}
