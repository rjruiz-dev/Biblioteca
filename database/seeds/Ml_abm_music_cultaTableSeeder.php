<?php

use Illuminate\Database\Seeder;

class Ml_abm_music_cultaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_music_culta::create([
            'many_lenguages_id'      => 1,
            'titulo_de_la_obra'      => 'titulo_de_la_obra',
            'titulo_del_disco'      => 'titulo_del_disco',
            'compositor'      => 'compositor',
            'orquesta'      => 'orquesta',
            'solista'      => 'solista'
            ]);
    }
}
