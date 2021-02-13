<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_reference extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_exito_ref',
        'swal_info_exito_ref', 'swal_eliminar_ref', 'swal_info_eliminar_ref','swal_advertencia_ref', 'swal_info_advertencia_ref',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }

}
    