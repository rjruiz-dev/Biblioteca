<?php

use Illuminate\Database\Seeder;

class Ml_multimediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_multimedia::create([
            'many_lenguages_id'      => 1,
            'sobre_multimedia'      => 'sobre multimedia',
            'detalles_de_multimedia'      => 'detalles de multimedia',
            'paginas'      => 'paginas',
            'volumen'      => 'volumen',
            'edicion'      => 'edicion',
            ]);
    }
}
