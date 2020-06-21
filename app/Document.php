<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [ 
        'adequacies_id', 'lengueges_id', 'document_types_id', 'creators_id', 'title', 'original_title', 'acquired', 'document_status',
        'let_author', 'cdu', 'let_title', 'assessment', 'desidherata', 'published', 'made_by', 'year', 'volume', 'quantity', 'collection', 'location',
        'observation', 'note', 'synopsis', 'photo'
    ];

    public function adequacy()
    {
        return $this->belongsTo(Adequacy::class);
    }

    public function lenguage()
    {
        return $this->belongsTo(Lenguage::class);
    }

    public function creators()
    {
        return $this->belongsTo(Creator::class);
    }

    public function document_type()
    {
        return $this->belongsTo(Document_type::class);
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
