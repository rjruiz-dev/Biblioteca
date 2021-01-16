<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_web_request extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_wr', 'subtitulo_wr', 'dt_id_wr', 'dt_nombre_wr',           
        'dt_usuario_wr', 'dt_email_wr', 'dt_estado_wr', 'dt_agregado_wr', 'dt_acciones_wr' 
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }

 
}