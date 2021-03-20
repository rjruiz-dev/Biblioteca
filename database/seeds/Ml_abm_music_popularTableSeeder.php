<?php

use Illuminate\Database\Seeder;

class Ml_abm_music_popularTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_music_popular::create([
            'many_lenguages_id'      => 1,
            'titulo'      => 'titulo',
            'subtítulo'      => 'subtítulo',
            'artista'      => 'artista',
            'otros_artistas'      => 'otros artistas',
            'musica'      => 'musica',
            'título_original'      => 'título original'
            ]);
    }
}
