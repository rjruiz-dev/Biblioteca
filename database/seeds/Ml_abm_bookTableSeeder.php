<?php

use Illuminate\Database\Seeder;

class Ml_abm_bookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_book::create([
            'many_lenguages_id'      => 1,
            'crear_libro'      => 'Crear Libro',
            'tipo_de_libro'      => 'Tipo de Libro',
            'ph_tipo_de_libro'      => 'Tipo de Libro',
            'numero_de_paginas'      => 'Numero de Paginas',
            ]);
    }
}
