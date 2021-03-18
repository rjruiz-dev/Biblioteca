<?php

use Illuminate\Database\Seeder;

class Generate_formatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Generate_format::unguard();

        App\Generate_format::create([
            'id'      => 100,
            'genre_format'      => 'Sin Formato desde Rebecca',
        ]);
    }
}
