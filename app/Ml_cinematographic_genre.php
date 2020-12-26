<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_cinematographic_genre extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_gc', 'titulo_gc', 'subtitulo_gc', 'dt_id_gc', 'dt_gc','dt_agregado_gc',
        'dt_acciones_gc', 'mod_titulo_gc','mod_subtitulo_gc','cam_gc'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
