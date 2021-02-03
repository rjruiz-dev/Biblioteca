<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_graphic_format extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_fg', 'titulo_fg', 'subtitulo_fg', 'dt_id_fg', 'dt_fg','dt_agregado_fg',
        'dt_acciones_fg', 'mod_subtitulo_fg','cam_fg'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
