<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_course extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_curso', 'titulo_curso', 'subtitulo_curso', 'dt_id_curso', 'dt_curso','dt_grupo',
        'dt_agregado_curso', 'dt_estado','dt_acciones_curso','mod_subtitulo_curso','cam_nombre_curso', 
        'cam_grupo', 'cam_grupo_si','cam_grupo_no'
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
