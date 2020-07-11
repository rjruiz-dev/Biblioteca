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
        factory(App\Generate_reference::class, 6)->create();       
    }
}
