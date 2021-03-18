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
        App\Photography_movie::unguard();

        App\Photography_movie::create([
            'id'      => 100,
            'photography_movie_name'      => 'import rebecca',
        ]);
    }
}
