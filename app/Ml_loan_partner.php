<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_loan_partner extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_lp', 'subtitulo_lp', 'dt_id_lp','dt_socio_lp','dt_nickname_lp',
        'dt_nombre_lp','dt_email_lp', 'dt_estado_lp', 'dt_acciones_lp','titulo_index_lp','seccion_socio',
        'genero','fecha_nac', 'email','telefono','direccion','cod_postal','ciudad', 'provincia',
        'seccion_prestamo','num_copia','prestado_el', 'devolver_el','dias_retraso','sancion',
        'economica','btn_devolver','btn_renovar', 'btn_cerrar','btn_si', 'mod_titulo_lp', 'mod_subtitulo_lp',           
        'cam_devolver_lp'      
    
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }

   
}
