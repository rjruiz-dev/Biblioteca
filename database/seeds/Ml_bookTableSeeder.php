<?php

use Illuminate\Database\Seeder;

class Ml_bookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_book::create([
            'many_lenguages_id'      => 1,
            'tema_de_portada'      => 'tema de portada',
            'sobre_el_documento'      => 'sobre el documento',
            'subtitulo'      => 'subtitulo',
            'otros_autores'      => 'otros autores',
            'publicado_en'      => 'publicado en',
            'detalles_del_documento'      => 'detalles del documento',
            'volumen'      => 'volumen',
            'numero_de_paginas'      => 'numero de paginas',
            'tamanio'      => 'tamaño',
            ]);
    }
}
