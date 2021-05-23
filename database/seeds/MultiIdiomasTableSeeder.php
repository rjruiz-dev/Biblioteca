<?php

use Illuminate\Database\Seeder;

class MultiIdiomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_dashboard::create([
            'many_lenguages_id'      => 1, // 1 
            'biblioteca'      => 'biblioteca',
            'iniciar_sesion'      => 'iniciar sesion', // 1
            'registrarse'      => 'registrarse', // 1 
            'navegacion'      => 'navegacion', // 1 
            'invitado'      => 'invitado', // 1 
            'en_linea'      => 'en linea', // 1 
            'gestion'      => 'gestion', // 1 
            'prestamos_web'      => 'prestamos desde la web', // 1 
            'prestamos_manuales'      => 'prestamos manuales', // 1 
            'prest_y_dev'      => 'prestamos y devoluciones', // 1 
            'pyd_por_socio'      => 'por socios', // 1 
            'pyd_por_doc'      => 'por documentos', // 1 
            'correspondencia'      => 'correspondencia', // 1 
            'reclamar_prestamos'      => 'reclamar prestamos', // 1 
            'socios'      => 'socios', // 1 
            'socios_alta_manual'      => 'alta manual de socios', // 1 
            'socios_solicitudes'      => 'solicitudes desde la web', // 1 
            'catalogo'      => 'catalogo', // 1 
            'libros'      => 'libros', // 1 
            'cines'      => 'cines', // 1 
            'musica'      => 'musica', // 1 
            'fotografia'      => 'fotografia', // 1 
            'multimedia'      => 'multimedia', // 1 
            'importar_rebeca'      => 'importar rebeca', // 1
            'importaciones_rebeca'      => 'importaciones rebeca', // 1 
            'mantenimiento'      => 'mantenimiento', // 1 
            'mant_cursos'      => 'cursos', // 1 
            'mant_maestros'      => 'maestro de referencias', // 1 
            'mant_formatos'      => 'formatos graficos', // 1 
            'mant_idiomas'      => 'idiomas', // 1 
            'mant_public_period'      => 'publicaciones periodicas', // 1 
            'mant_generos_lit'      => 'generos literarios', // 1 
            'mant_generos_musicales'      => 'generos musicales', // 1 
            'mant_generos_cinemato'      => 'generos cinematograficos', // 1 
            'mant_personas_adecuadas'      => 'personas adecuadas', // 1 
            'mant_materias'      => 'materias', // 1 
            'mant_modelos_carta'      => 'modelos de cartas', // 1 
            'listados'      => 'listados', // 1 
            'prestamos_por_fecha'      => 'prestamos por fecha', // 1 
            'prestamos_por_aula'      => 'prestamos por aula', // 1 
            'registros_db'      => 'registros base de datos', // 1 
            'estadisticas'      => 'estadisticas', // 1 
            'gestion_multi_idioma'      => 'gestion multi-idioma', // 1 
            ]);
        }
    }
