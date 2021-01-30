<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_partner extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_ams','subtitulo_ams', 'dt_id_ams','dt_usuario_ams', 
        'dt_nickname_ams','dt_perfil_ams', 'dt_nombre_ams', 'dt_email_ams', 'dt_estado_ams', 'dt_agregado_ams',
        'dt_acciones_ams','mod_titulo','seccion_perfil','mod_select_tipo','mod_check_biblio', 'mod_check_socio', 'mod_num_user',
        'mod_span_num','mod_nickname','mod_select_estado', 'mod_ph_estado','mod_imagen',
        'mod_span_email', 'seccion_personales','mod_nombre','mod_apellido','mod_select_genero','mod_ph_genero',  
        'mod_fecha_nac', 'mod_pass','mod_span_pass','mod_repite_pass', 'seccion_direccion',  
        'mod_telefono', 'mod_direccion', 'mod_cod_postal', 'mod_ciudad', 'mod_select_provincia',
        'mod_ph_provincia', 'mod_titulo_show', 'mod_usuario', 'mod_email', 'mod_estado',            
        'mod_info_direccion', 'mod_info_cod_postal', 'mod_info_telefono', 'btn_crear','btn_actualizar',       
        'btn_cerrar','noti_alta_socio','noti_edicion_socio','preg_reactivar_socio','resp_reactivar_socio',
        'preg_baja_socio','resp_baja_socio','mensaje_exito'
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}

    

