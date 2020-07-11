<?php

use Illuminate\Database\Seeder;

class Generate_multimediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generate_multimedia::class, 4)->create();
    }
}
