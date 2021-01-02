<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_loan_by_date extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_ld', 'titulo_ld', 'subtitulo_ld', 'fecha_desde_ld', 'fecha_hasta_ld','dt_id_ld', 'dt_registro_ld', 'dt_titulo_ld','dt_tipodoc_ld',
        'dt_subtipodoc_ld', 'dt_nrosocio_ld','dt_nombre_ld','dt_fechaprestamo_ld','dt_fechadevolucion_ld'
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
