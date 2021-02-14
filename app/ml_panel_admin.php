<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_panel_admin extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 
        'doc_mas_recientes',
        'panel_de_control',
        'documentos',
        'documentos_registrados',
        'prestamos',
        'prestamos_registrados',
        'prestamos_vencidos',
        'vencidos_registrados',
        'usuarios',
        'usuarios_registrados',
        'ultimos_cinco_prestamos',
        'pres_id',
        'pres_prefil',
        'pres_nombre',
        'pres_email',
        'pres_titulo',
        'pres_fecha_devolucion',
        'pres_n_ejemplar',
        'pres_cant_prestamos',
        'prestamos_vencidos',
        'venc_id',
        'venc_perfil',
        'venc_nombre',
        'venc_email',
        'venc_titulo',
        'venc_fecha_devolucion',
        'venc_n_ejemplar',
        'venc_cant_prestamos'
    ];
}
