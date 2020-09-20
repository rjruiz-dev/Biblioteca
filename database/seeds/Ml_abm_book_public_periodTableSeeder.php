<?php

use Illuminate\Database\Seeder;

class Ml_abm_book_public_periodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_book_publ_period::create([
            'many_lenguages_id'      => 1,
            'tema_de_portada'      => 'tema de portada',
            'volumen_numero_y_fecha'      => 'volumen, numero y fecha',
            'periodicidad'      => 'periodicidad',
            'issn'      => 'issn'
            ]);
    }
}
