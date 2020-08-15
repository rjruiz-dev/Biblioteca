<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $fillable = [ 
        'document_types_id', 'creator_name'
    ];

    public function document_type()
    {
        return $this->belongsTo(Document_type::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    } 

    public function popular()
    {
        return $this->hasMany(Popular::class);
    } 
}
