<?php

use Illuminate\Database\Seeder;

class Ml_abm_fotografiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_fotografia::create([
            'many_lenguages_id'      => 1,
            'crear_fotografia'      => 'crear_fotografia',
            'tipo_de_fotografia'      => 'tipo_de_fotografia',
            'realizador'      => 'realizador',
            'edicion'      => 'edicion',
            'num_diapositivas'      => 'num_diapositivas',
            'Observaciones'      => 'Observaciones',
            'detalles_de_la_fotografia'      => 'detalles_de_la_fotografia'
            ]);
    }
}
