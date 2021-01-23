<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_registry extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo_reg', 'info_reg', 'seccion', 'nombre_reg',
        'apellido_reg', 'nickname_reg', 'email_reg', 'fecha_nac_reg', 'ph_fecha_nac_reg','btn_cerrar_reg',
        'btn_enviar_reg'
    ];
   
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}


