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
            'crear_libro'      => 'crear_libro',
            'tipo_de_libro'      => 'tipo_de_libro',
            'ph_tipo_de_libro'      => 'ph_tipo_de_libro',
            'numero_de_paginas'      => 'numero_de_paginas',
            ]);
    }
}
