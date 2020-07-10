<?php

use Illuminate\Database\Seeder;

class PhotographyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Photography::class, 2)->create();
    }
}
