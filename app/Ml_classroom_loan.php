<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_classroom_loan extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_lc', 'titulo_lc', 'subtitulo_lc', 'curso_lc', 'letra_lc','turno_lc', 'dt_registro_lc', 'dt_titulo_lc', 'dt_autor_lc', 'dt_tipodoc_lc',
        'dt_subtipodoc_lc', 'dt_nrosocio_lc','dt_socio_lc', 'dt_curso_lc', 'dt_fechaprestamo_lc','dt_fechadevolucion_lc'
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
