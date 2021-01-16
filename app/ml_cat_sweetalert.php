<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ml_cat_sweetalert extends Model
{
    protected $fillable = [
        'mensaje_exito',
        'alta_documento',
        'actualizacion_documento',

        'preg_solicitar_documento',
        'resp_solicitar_documento',

        'preg_baja_documento',
        'resp_baja_documento',

        'preg_rechazar_documento',
        'resp_rechazar_documento',

        'preg_reactivar_documento',
        'resp_reactivar_documento',

        'preg_aceptar_documento',
        'resp_aceptar_documento',

        'preg_desidherata_documento',
        'resp_desidherata_documento',

        'actualizacion_copia',
        'alta_copia'
    ];
}
