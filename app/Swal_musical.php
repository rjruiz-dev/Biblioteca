<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_musical extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_mus','swal_info_exito_mus', 'swal_eliminar_mus',
        'swal_info_eliminar_mus','swal_advertencia_mus','swal_info_advertencia_mus'   
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}

         