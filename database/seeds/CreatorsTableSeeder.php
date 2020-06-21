<?php

use Illuminate\Database\Seeder;

class CreatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Creator::class, 5)->create();
    }
}
