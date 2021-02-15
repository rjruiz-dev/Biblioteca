<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_graphic_format extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_exito_gra',
        'swal_info_exito_gra', 'swal_eliminar_gra', 'swal_info_eliminar_gra','swal_advertencia_gra', 'swal_info_advertencia_gra',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
