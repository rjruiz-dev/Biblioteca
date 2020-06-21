<?php

use Illuminate\Database\Seeder;

class LenguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lenguage::class, 2)->create();
    }
}
