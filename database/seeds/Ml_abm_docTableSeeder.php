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
            'segundo_autor'      => 'segundo_autor',
            'tercer_autor'      => 'tercer_autor',
            'título_original'      => 'título_original',
            'traductor'      => 'traductor',
            'Isbn'      => 'Isbn',
            'adquirido'      => 'adquirido',
            'adecuado_para'      => 'adecuado_para',
            'siglas_autor'      => 'siglas_autor',
            'siglas_titulo'      => 'siglas_titulo',
            'cdu'      => 'cdu',
            'valoración'      => 'valoración',
            'desidherata'      => 'desidherata',
            'contenido_sinopsis_o_indice'      => 'contenido_sinopsis_o_indice',
            'publicado_en'      => 'publicado_en',
            'anio_de_publicación'      => 'anio_de_publicación',
            'edicion'      => 'edicion',
            'tamanio'      => 'tamanio',
            'volumenes'      => 'volumenes',
            'coleccion'      => 'coleccion',
            'editorial'      => 'editorial',
            'ubicacion'      => 'ubicacion',
            'idioma'      => 'idioma',
            'referencia'      => 'referencia',
            'observacion'      => 'observacion',
            'genero'      => 'genero',
            'editado_en'      => 'editado_en',
            'sello_discografico'      => 'sello_discografico',
            'fotografia'      => 'fotografia',
            'duracion'      => 'duracion',
            'formato'      => 'formato',
            'director'      => 'director',
            'plh_autor'      => 'Seleccione_o_ingrese un autor', 
            'plh_segundo_autor'      => 'Seleccione_o_ingrese un Segundo Autor', 
            'plh_tercer_autor'      => 'Seleccione_o_ingrese un Tercer Autor', 
            'plh_adquisicion'      => 'Ingrese_la_fecha de Adquisicion',
            'plh_adecuado_para'      => 'Seleccione_una_Adecuacion', 
            'plh_cdu'      => 'Seleccione_una_Cdu', 
            
            ]);
    }
}
