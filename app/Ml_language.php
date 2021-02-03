<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_language extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_lang', 'titulo_lang', 'subtitulo_lang', 'dt_id_lang', 'dt_lang','dt_agregado_lang',
        'dt_acciones_lang', 'mod_subtitulo_lang','cam_lang'
    ];
   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
