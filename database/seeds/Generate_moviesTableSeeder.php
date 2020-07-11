<?php

use Illuminate\Database\Seeder;

class Generate_moviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generate_movie::class, 6)->create();
    }
}
