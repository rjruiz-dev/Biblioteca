<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManyLenguages extends Model
{
    protected $fillable = ['lenguage_description'];

    public function ml_dashboard()
    {
        return $this->hasMany(Ml_dashboard::class);
    }
    
}
