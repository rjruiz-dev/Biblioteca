<?php

use Illuminate\Database\Seeder;

class Ml_documentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_doc::create([
            'many_lenguages_id'      => 1,
            'imagen_de_portada'      => 'imagen de portada',
            'idioma'      => 'idioma',
            'disponible_desde'      => 'disponible desde',
            'adecuado_para'      => 'adecuado para',
            'ubicacion'      => 'ubicacion',
            'solicitar_prestamo'      => 'solicitar prestamo',
            'valoracion'      => 'valoracion',
            'anio'      => 'año',
            'subtipo_de_documento'      => 'subtipo de documento',
            'titulo'      => 'titulo',
            'autor'      => 'autor',
            'sinopsis'      => 'sinopsis',
            'titulo_original'      => 'titulo original',
            'editorial'      => 'editorial',
            'nacionalidad'      => 'nacionalidad',
            'genero'      => 'genero',
            'duracion'      => 'duracion',
            'formato'      => 'formato',
            ]);
    }
}
