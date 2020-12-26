<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_literary_genre extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_gl', 'titulo_gl', 'subtitulo_gl', 'dt_id_gl', 'dt_gl','dt_agregado_gl',
        'dt_acciones_gl', 'mod_titulo_gl','mod_subtitulo_gl','cam_gl'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
