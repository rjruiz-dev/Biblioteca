<?php

use Illuminate\Database\Seeder;

class Ml_abm_movieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_cine::create([
            'many_lenguages_id'      => 1,
            'crear_cine'      => 'Crear Cine',
            'reparto'      => 'reparto',
            'adaptacion'      => 'adaptacion',
            'guión'      => 'guión',
            'cont_específico'      => 'contenido específico',
            'diglas_director'      => 'siglas director',
            'nacionalidad'      => 'nacionalidad',
            'productora'      => 'productora',
            'distribuidora'      => 'distribuidora',
            'premios'      => 'premios'
            ]);
    }
}
