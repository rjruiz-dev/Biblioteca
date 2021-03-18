<?php

use Illuminate\Database\Seeder;

class Generate_filmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Generate_film::unguard();

        App\Generate_film::create([
            'id'      => 100,
            'genre_film'      => 'Sin Genero desde Rebecca',
        ]);
    }
}
