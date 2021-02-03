<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_periodical_publication extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'btn_crear_publ', 'titulo_publ', 'subtitulo_publ', 'dt_id_publ', 'dt_publ','dt_agregado_publ',
        'dt_acciones_publ', 'mod_subtitulo_publ','cam_publ'
    ];

   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
