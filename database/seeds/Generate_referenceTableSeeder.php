<?php

use Illuminate\Database\Seeder;

class Generate_referenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reference::class, 6)->create();       
    }
}