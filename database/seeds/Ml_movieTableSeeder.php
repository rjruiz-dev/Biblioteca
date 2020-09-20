<?php

use Illuminate\Database\Seeder;

class Ml_movieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_movie::create([
            'many_lenguages_id'      => 1,
            'dirigido_por'      => 'dirigido_por',
            'sobre_la_pelicula'      => 'sobre_la_pelicula',
            'reparto'      => 'reparto',
            'productora'      => 'productora',
            'distribuidora'      => 'distribuidora',
            'detalles_de_la_pelicula'      => 'detalles_de_la_pelicula',
            'fotografia'      => 'fotografia',
            ]);
    }
}
