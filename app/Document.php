<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [ 
        'generate_subjects_id', 'generate_references_id', 'adequacies_id', 'lenguages_id', 'document_types_id', 'document_subtypes_id', 'creators_id', 'status_documents_id', 'title', 'original_title', 'acquired',
        'let_author', 'cdu', 'let_title', 'assessment', 'desidherata', 'published', 'made_by', 'year', 'volume', 'collection', 'location',
        'observation', 'note', 'temprebecca', 'synopsis', 'photo', 'origen', 'status_rebecca', 'quantity_generic'
    ];

    protected $dates = ['acquired', 'drop', 'year'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($movie){

            $movie->references()->detach()->delete();
        });
    }

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

    public function subjects()
    {
        return $this->belongsTo(Generate_subjects::class, 'generate_subjects_id');
    }
    
    public function copies()
    {
        return $this->hasMany(Copy::class);
    }
    
    public function status_document()
    {
        return $this->belongsTo(StatusDocument::class, 'status_documents_id');
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'id');
    }

    public function music()
    {
        return $this->hasOne(Music::class, 'id');
    }
    public function movie()
    {
        return $this->hasOne(Movies::class, 'id');
    }

    public function photography()
    {
        return $this->hasOne(Photography::class, 'id');
    }

    public function multimedia()
    {
        return $this->hasOne(Multimedia::class, 'id');
    }

    public function references()
    {
        return $this->belongsToMany('App\Generate_reference', 'document_generate_reference', 'document_id', 'generate_reference_id'); 
    }
    
    public function syncReferences($references)
    {
       $referencesIds = collect($references)->map(function($reference){
            return  Generate_reference::find($reference) ? $reference : Generate_reference::create(['reference_description' => $reference])->id;
        });                

        return $this->references()->sync($referencesIds);
    }
}
