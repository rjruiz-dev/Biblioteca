<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_library_profile extends Model
{
    protected $fillable = [ 
        'many_lenguages_id', 'titulo', 'logo', 'perfil', 'biblioteca', 'telefono', 'email',
        'idioma', 'select_logo', 'medidas_logo', 'direccion','calle','codigo_postal', 'ciudad',          
        'provincia', 'pais', 'config_prestamo', 'cant_max_prestamo','cant_max_dias', 'tipo_multa',          
        'economica', 'sancion','sancion_economica','dias_sancion', 'otros_detalles', 'edad_infantil',
        'edad_adulto', 'select_color','info_color','select_color_fuente','info_color_fuente', 
    ];
    
    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}


