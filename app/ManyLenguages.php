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
    
}
