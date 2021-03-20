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
            'crear_fotografia'      => 'crear fotografia',
            'tipo_de_fotografia'      => 'tipo de fotografia',
            'realizador'      => 'realizador',
            'edicion'      => 'edicion',
            'num_diapositivas'      => 'numero de diapositivas',
            'Observaciones'      => 'Observaciones',
            'detalles_de_la_fotografia'      => 'detalles de la fotografia'
            ]);
    }
}
