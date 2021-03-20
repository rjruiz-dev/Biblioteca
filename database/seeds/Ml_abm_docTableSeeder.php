<?php

use Illuminate\Database\Seeder;

class Ml_abm_docTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_doc::create([
            'many_lenguages_id'      => 1,
            'area_de_titulo'      => 'area de titulo',
            'area_de_edición'      => 'area de edición',
            'area_de_contenidos'      => 'area de contenidos',
            'cerrar'      => 'cerrar',
            'crear'      => 'crear',
            'titulo'      => 'titulo',
            'subtítulo'      => 'subtítulo',
            'autor'      => 'autor',
            'ph_autor'      => 'autor',
            'segundo_autor'      => 'segundo autor',
            'ph_segundo_autor'      => 'segundo autor',
            'tercer_autor'      => 'tercer autor',
            'ph_tercer_autor'      => 'tercer autor',
            'título_original'      => 'título original',
            'traductor'      => 'traductor',
            'Isbn'      => 'Isbn',
            'adquirido'      => 'adquirido',
            'ph_adquirido'      => 'adquirido',
            'adecuado_para'      => 'adecuado para',
            'ph_adecuado_para'      => 'adecuado para',
            'siglas_autor'      => 'siglas autor',
            'ph_siglas_autor'      => 'siglas autor',
            'siglas_titulo'      => 'siglas titulo',
            'ph_siglas_titulo'      => 'siglas titulo',
            'cdu'      => 'cdu',
            'ph_cdu'      => 'cdu',
            'valoración'      => 'valoración',
            'desidherata'      => 'desidherata',
            'contenido_sinopsis_o_indice'      => 'contenido, sinopsis o indice',
            'publicado_en'      => 'publicado en',
            'anio_de_publicación'      => 'año de publicación',
            'ph_anio_de_publicación'      => 'año de publicación',
            'tamanio'      => 'tamaño',
            'volumenes'      => 'volumenes',
            'coleccion'      => 'coleccion',
            'edicion'      => 'edicion',
            'ph_edicion'      => 'edicion',
            'editorial'      => 'editorial_',
            'ph_editorial'      => 'editorial',
            'ubicacion'      => 'ubicacion',
            'idioma'      => 'idioma',
            'ph_idioma'      => 'idioma',
            'referencia'      => 'referencia',
            'ph_referencia'      => 'referencia',
            'observacion'      => 'observacion',
            'ph_observacion'      => 'observacion',
            'genero'      => 'genero',
            'editado_en'      => 'editado en',
            'sello_discografico'      => 'sello discografico',
            'fotografia'      => 'fotografia',
            'duracion'      => 'duracion',
            'formato'      => 'formato',
            'director'      => 'director',
            ]);
    }
}
