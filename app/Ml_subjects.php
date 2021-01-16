<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_subjects extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_subject', 'titulo_subject', 'subtitulo_subject', 'dt_id_subject',  'dt_subject', 'dt_cdu_subject', 'dt_agregado_subject',
        'dt_acciones_subject', 'mod_titulo_subject','mod_subtitulo_subject','cam_subject', 'cam_cdu_subject'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
