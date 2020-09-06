<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_dashboard extends Model
{
    protected $fillable = ['many_lenguages_id', 'navegacion'];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
