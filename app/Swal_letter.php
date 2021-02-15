<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_letter extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_let','swal_info_exito_let', 'swal_eliminar_let',
        'swal_info_eliminar_let','swal_advertencia_let','swal_info_advertencia_let'   
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
