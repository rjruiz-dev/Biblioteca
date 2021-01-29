<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_web_loan extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_wl', 'subtitulo_wl', 'dt_id_wl', 'dt_titulo_wl', 'dt_documento_wl',     
        'dt_tipo_wl', 'dt_subtipo_wl', 'dt_curso_wl', 'dt_agregado_wl', 'dt_acciones_wl',
        'mod_titulo','mod_tipo_doc','mod_subtipo_doc', 'mod_socio', 'mod_fecha', 'btn_aceptar',
        'btn_rechazar','btn_cerrar'
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}

