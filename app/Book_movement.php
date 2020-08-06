<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_movement extends Model
{
    protected $fillable = ['movement_types_id', 'users_id', 'copies_id', 'courses_id', 'grupo', 'turno', 'date', 'date_until', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function movement_type()
    {
        return $this->belongsTo(Movement_type::class, 'movement_types_id');
    }

    public function copy()
    {
        return $this->belongsTo(Copy::class, 'copies_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
