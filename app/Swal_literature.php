<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_literature extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_lit',
        'swal_info_exito_lit', 'swal_eliminar_lit', 'swal_info_eliminar_lit','swal_advertencia_lit', 'swal_info_advertencia_lit',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
