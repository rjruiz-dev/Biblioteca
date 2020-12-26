<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_musical_genre extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_gm', 'titulo_gm', 'subtitulo_gm', 'dt_id_gm', 'dt_gm','dt_agregado_gm',
        'dt_acciones_gm', 'mod_titulo_gm','mod_subtitulo_gm','cam_gm'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
