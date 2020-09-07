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
    
}
