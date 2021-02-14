<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_adequacy extends Model
{
    protected $fillable = [ 
        'many_lenguages_id','swal_exito_ade','swal_info_exito_ade', 'swal_eliminar_ade',
        'swal_info_eliminar_ade','swal_advertencia_ade','swal_info_advertencia_ade'   
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
