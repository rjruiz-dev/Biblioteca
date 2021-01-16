<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_statistic extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'estadistica', 'mes_y_año', 'ph_mes_y_año', 'btn_buscar', 'total', 'sub_socio', 'sub_prestamo',
        'sub_coleccion', 'col_tipodesocio', 'col_alta', 'col_baja', 'col_prestamo',  'col_libro', 'col_cine', 'col_multimedia',
        'col_fotografia', 'col_librodigital', 'col_coleccion', 'infantil', 'adulto', 'incorporacion', 'baja', 
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
