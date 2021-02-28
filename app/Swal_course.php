<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_course extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_exito', 'swal_info_exito', 'swal_info_eliminar','swal_advertencia', 'swal_advertencia','swal_info_advertencia',
        'swal_baja','swal_bajado','swal_reactivar','swal_reactivado'  
    ];    

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }

       
   
}


