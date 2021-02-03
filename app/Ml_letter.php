<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_letter extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_letter', 'titulo_letter', 'subtitulo_letter', 'dt_id_letter',  'dt_titulo_letter', 'dt_cuerpo_letter', 'dt_despedida_letter', 'dt_agregado_letter',
        'dt_acciones_letter', 'mod_subtitulo_letter','cam_titulo_letter', 'cam_cuerpo_letter', 'cam_despedida_letter'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
