<?php

use Illuminate\Database\Seeder;

class Ml_abm_musicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_music::create([
            'many_lenguages_id'      => 1,
            'crear_musica'      => 'crear musica',
            'tipo_de_musica'      => 'tipo de musica',
            'productor'      => 'productor',
            'siglas_compositor'      => 'siglas compositor',
            'volumenes'      => 'volumenes'
            ]);
    }
}
