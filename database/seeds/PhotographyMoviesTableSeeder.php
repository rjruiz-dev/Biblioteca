<?php

use Illuminate\Database\Seeder;

class PhotographyMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Photography_movie::class, 10)->create();
    }
}
