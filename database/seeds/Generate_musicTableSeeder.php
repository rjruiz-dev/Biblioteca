<?php

use Illuminate\Database\Seeder;

class Generate_musicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Generate_music::unguard();

        App\Generate_music::create([
            'id'      => 100,
            'genre_music'      => 'Sin Genero desde Rebecca',
        ]);
    }
}
