<?php

use Illuminate\Database\Seeder;

class Ml_abm_book_otrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_book_otros::create([
            'many_lenguages_id'      => 1,
            'otros'      => 'otros',
            'plh_otros'      => 'Seleccione_Otros',
            ]);
    }
}
