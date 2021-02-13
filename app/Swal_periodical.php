<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swal_periodical extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'swal_exito_per',
        'swal_info_exito_per', 'swal_eliminar_per', 'swal_info_eliminar_per','swal_advertencia_per', 'swal_info_advertencia_per',    
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
