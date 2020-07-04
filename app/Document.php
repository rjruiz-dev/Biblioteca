<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [ 
        'adequacies_id', 'lenguages_id', 'document_types_id', 'document_subtypes_id', 'creators_id', 'title', 'registry_number', 'original_title', 'acquired', 'drop', 'document_status',
        'let_author', 'cdu', 'let_title', 'assessment', 'desidherata', 'published', 'made_by', 'year', 'volume', 'quantity', 'collection', 'location',
        'observation', 'note', 'synopsis', 'photo', 'quantity_generic'
    ];

    protected $dates = ['acquired', 'drop', 'year'];

    public function adequacy()
    {
        return $this->belongsTo(Adequacy::class, 'adequacies_id');
    }

    public function lenguage()
    {
        return $this->belongsTo(Lenguage::class, 'lenguages_id');
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class, 'creators_id');
    }

    public function document_type()
    {
        return $this->belongsTo(Document_type::class, 'document_types_id');
    }

    public function document_subtype()
    {
        return $this->belongsTo(Document_subtype::class, 'document_subtypes_id');
    }
    
    public function copies()
    {
        return $this->hasMany(Copy::class);
    } 

    public function music()
    {
        return $this->hasOne(Music::class);
    }
    public function movie()
    {
        return $this->hasOne(Movies::class);
    }

    public function photography()
    {
        return $this->hasOne(Photography::class);
    }

    public function multimedia()
    {
        return $this->hasOne(Multimedia::class);
    }
}
