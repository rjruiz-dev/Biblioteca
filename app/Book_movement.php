<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_movement extends Model
{
    protected $fillable = ['movement_types_id', 'users_id', 'copies_id', 'courses_id', 'date', 'date_until', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movement_type()
    {
        return $this->belongsTo(Movement_type::class);
    }

    public function copy()
    {
        return $this->belongsTo(Copy::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
