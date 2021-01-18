<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_adequacy extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_adequacy', 'titulo_adequacy', 'subtitulo_adequacy', 'dt_id_adequacy', 'dt_adequacy','dt_agregado_adequacy',
        'dt_acciones_adequacy', 'mod_subtitulo_adequacy','cam_adequacy'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
