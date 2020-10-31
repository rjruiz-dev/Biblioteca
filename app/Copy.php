<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    protected $fillable = ['documents_id','registry_number'];

    
    public function document()
    {
        return $this->belongsTo(Document::class, 'documents_id');
    }

    public function movement_type()
    {
        return $this->belongsTo(Movement_type::class,'status_copy_id');
    }
    
    public function book_movements()
    {
        return $this->hasMany(Book_movement::class, 'copies_id');
    } 
}
