<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_manual_loan extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_ml', 'subtitulo_ml', 'dt_id_ml','dt_titulo_ml', 'dt_tipo_ml', 'dt_subtipo_ml',      
        'dt_copias_ml', 'dt_acciones_ml', 'titulo_index', 'seccion_doc','tipo_doc', 'tipo_libro', 'seccion_prestamo',
        'select_registro', 'ph_registro', 'select_usuario', 'ph_usuario', 'nickname',  'apellido', 'email', 'cant_prestamos',          
        'select_curso', 'ph_curso', 'select_grupo', 'ph_grupo', 'select_turno', 'ph_turno',  'fecha_prestamo','btn_prestar'
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}


