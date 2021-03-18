<?php

use Illuminate\Database\Seeder;

class Generate_bookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Generate_book::unguard();

        App\Generate_book::create([
            'id'      => 100,
            'genre_book'      => 'Sin Genero desde Rebecca',
        ]);
    }
}
