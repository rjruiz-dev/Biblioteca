<?php

use Illuminate\Database\Seeder;

class Ml_abm_multimediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_multimedia::create([
            'many_lenguages_id'      => 1,
            'crear_multimedia'      => 'crear_multimedia'
            ]);
    }
}
