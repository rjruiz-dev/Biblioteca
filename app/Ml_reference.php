<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_reference extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_ref', 'subtitulo_ref', 'btn_crear_ref', 'dt_id_ref', 'dt_referencia',
        'dt_agregado_ref', 'dt_acciones_ref','mod_subtitulo_ref','cam_referencia'       
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
