<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ml_dashboard extends Model
{
    protected $fillable = [ 'many_lenguages_id', 'biblioteca', 'iniciar_sesion', 'registrarse', 
                            'navegacion', 'inivitado','en_linea','inicio','gestion','prestamos_web','prestamos_manuales','prest_y_dev','pyd_por_socio','pyd_por_doc','correspondencia','reclamar_prestamos','socios','socios_alta_manual','socios_solicitudes','catalogo','libros', 'cines',
                            'musica', 'fotografia', 'multimedia','importar_rebeca','mantenimiento','mant_cursos','mant_maestros','mant_formatos','mant_idiomas','mant_public_period','mant_generos_lit','mant_generos_musicales','mant_generos_cinemato','mant_personas_adecuadas','mant_materias','mant_modelos_carta','listados', 'prestamos_por_fecha','prestamos_por_aula','registros_db','estadisticas','gestion_multi_idioma'
                        ];

    public function many_lenguage()
    {
        return $this->belongsTo(ManyLenguages::class, 'many_lenguages_id');
    }
}
