<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_course extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear', 'titulo', 'subtitulo', 'dt_id', 'dt_curso','dt_grupo',
        'dt_agregado', 'dt_estado','dt_acciones','mod_titulo','mod_subtitulo','cam_nombre_curso', 
        'cam_grupo', 'cam_grupo_si','cam_grupo_no'
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
