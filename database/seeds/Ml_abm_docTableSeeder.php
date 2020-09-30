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
            'area_de_titulo'      => 'area_de_titulo',
            'area_de_edición'      => 'area_de_edición',
            'area_de_contenidos'      => 'area_de_contenidos',
            'cerrar'      => 'cerrar',
            'crear'      => 'crear',
            'titulo'      => 'titulo',
            'subtítulo'      => 'subtítulo',
            'autor'      => 'autor',
            'ph_autor'      => 'ph_autor',
            'segundo_autor'      => 'segundo_autor',
            'ph_segundo_autor'      => 'ph_segundo_autor',
            'tercer_autor'      => 'tercer_autor',
            'ph_tercer_autor'      => 'ph_tercer_autor',
            'título_original'      => 'título_original',
            'traductor'      => 'traductor',
            'Isbn'      => 'Isbn',
            'adquirido'      => 'adquirido',
            'ph_adquirido'      => 'ph_adquirido',
            'adecuado_para'      => 'adecuado_para',
            'ph_adecuado_para'      => 'ph_adecuado_para',
            'siglas_autor'      => 'siglas_autor',
            'ph_siglas_autor'      => 'ph_siglas_autor',
            'siglas_titulo'      => 'siglas_titulo',
            'ph_siglas_titulo'      => 'ph_siglas_titulo',
            'cdu'      => 'cdu',
            'ph_cdu'      => 'ph_cdu',
            'valoración'      => 'valoración',
            'desidherata'      => 'desidherata',
            'contenido_sinopsis_o_indice'      => 'contenido_sinopsis_o_indice',
            'publicado_en'      => 'publicado_en',
            'anio_de_publicación'      => 'anio_de_publicación',
            'ph_anio_de_publicación'      => 'ph_anio_de_publicación',
            'tamanio'      => 'tamanio',
            'volumenes'      => 'volumenes',
            'coleccion'      => 'coleccion',
            'edicion'      => 'edicion',
            'ph_edicion'      => 'ph_edicion',
            'editorial'      => 'editorial_',
            'ph_editorial'      => 'ph_editorial',
            'ubicacion'      => 'ubicacion',
            'idioma'      => 'idioma',
            'ph_idioma'      => 'ph_idioma',
            'referencia'      => 'referencia',
            'ph_referencia'      => 'ph_referencia',
            'observacion'      => 'observacion',
            'ph_observacion'      => 'ph_observacion',
            'genero'      => 'genero',
            'editado_en'      => 'editado_en',
            'sello_discografico'      => 'sello_discografico',
            'fotografia'      => 'fotografia',
            'duracion'      => 'duracion',
            'formato'      => 'formato',
            'director'      => 'director',
            ]);
    }
}
