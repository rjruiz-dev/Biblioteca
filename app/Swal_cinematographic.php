<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_cinematographic extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_cin','swal_info_exito_cin', 'swal_eliminar_cin',
        'swal_info_eliminar_cin','swal_advertencia_cin','swal_info_advertencia_cin'   
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
