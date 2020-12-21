<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_reference extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo', 'subtitulo', 'btn_crear', 'dt_id', 'dt_referencia',
        'dt_agregado', 'dt_acciones','mod_titulo','mod_subtitulo','cam_formato'       
    ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
