<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManyLenguages extends Model
{
    protected $fillable = ['lenguage_description','baja'];

    public function ml_dashboard()
    {
        return $this->hasMany(Ml_dashboard::class);
    }

    public function ml_document()
    {
        return $this->hasMany(Ml_document::class);
    }

    public function ml_movie()
    {
        return $this->hasMany(Ml_movie::class);
    }

    public function ml_course()
    {
        return $this->hasMany(Ml_course::class);
    }

    public function ml_reference()
    {
        return $this->hasMany(Ml_reference::class);
    }

    public function ml_graphic_format()
    {
        return $this->hasMany(Ml_graphic_format::class);
    }

    public function ml_language()
    {
        return $this->hasMany(Ml_language::class);
    }
    
    public function ml_periodical_publication()
    {
        return $this->hasMany(Ml_periodical_publication::class);
    }

    public function ml_literary_genre()
    {
        return $this->hasMany(Ml_literary_genre::class);
    }

    public function ml_musical_genre()
    {
        return $this->hasMany(Ml_musical_genre::class);
    }

    public function ml_cinematographic_genre()
    {
        return $this->hasMany(Ml_cinematographic_genre::class);
    }

    public function ml_adequacy()
    {
        return $this->hasMany(Ml_adequacy::class);
    }

    public function ml_subjects()
    {
        return $this->hasMany(Ml_subjects::class);
    }

    public function ml_letter()
    {
        return $this->hasMany(Ml_letter::class);
    }
}
