<?php

use Illuminate\Database\Seeder;

class Ml_musicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_music::create([
            'many_lenguages_id'      => 1,
            'titulo_de_la_obra'      => 'titulo de la obra',
            'director'      => 'director',
            'sobre_la_musica'      => 'sobre la musica',
            'compositor'      => 'compositor',
            'orquesta'      => 'orquesta',
            'editado_en'      => 'editado en',
            'sello_discofrafico'      => 'sello discofrafico',
            'detalles_de_la_musica'      => 'detalles de la musica',
            ]); 
    }
}
