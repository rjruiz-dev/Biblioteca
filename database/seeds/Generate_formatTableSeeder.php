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
        factory(App\Generate_format::class, 6)->create();
    }
}
