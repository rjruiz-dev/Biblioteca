<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_subject extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_sub','swal_info_exito_sub', 'swal_eliminar_sub',
        'swal_info_eliminar_sub','swal_advertencia_sub','swal_info_advertencia_sub'   
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
