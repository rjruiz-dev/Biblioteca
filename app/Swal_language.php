<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_language extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_lan',
        'swal_info_exito_lan', 'swal_eliminar_lan', 'swal_info_eliminar_lan','swal_advertencia_lan', 'swal_info_advertencia_lan',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
