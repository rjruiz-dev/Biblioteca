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
        factory(App\Generate_film::class, 6)->create();
    }
}
