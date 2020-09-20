<?php

use Illuminate\Database\Seeder;

class Ml_abm_book_litTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_abm_book_lit::create([
            'many_lenguages_id'      => 1,
            'genero'      => 'genero',
            ]);
    }
}
