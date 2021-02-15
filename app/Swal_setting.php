<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_setting extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_exito_set',
        'swal_info_exito_set'
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
