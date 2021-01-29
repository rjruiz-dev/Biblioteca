<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_loan_document extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_ld', 'subtitulo_ld', 'dt_id_ld', 'dt_titulo_ld', 
        'dt_tipo_ld', 'dt_subtipo_ld','dt_copias_ld', 'dt_acciones_ld', 'titulo_index_ld', 'seccion_doc',
        'tipo_doc','tipo_libro', 'num_copia_ld', 'estado', 'prestado_a','prestado_ld',                      
        'devolver_ld', 'dias_retraso_ld','sancion_ld', 'economica_ld','btn_devolver',      
        'btn_devolver', 'btn_prestamo','btn_cerrar','btn_si','mod_titulo_ld','mod_subtitulo_ld',           
        'cam_devolver_ld', 'btn_prestamo_ld','dias_resto_ld'
    
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }

              
}
