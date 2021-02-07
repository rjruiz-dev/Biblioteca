<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_language extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_language', 'swal_exito',
        'swal_info_exito', 'swal_eliminar', 'swal_info_eliminar','swal_advertencia', 'swal_info_advertencia',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
