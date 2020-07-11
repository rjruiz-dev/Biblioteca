<?php

use Illuminate\Database\Seeder;

class MultimediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Multimedia::class, 10)->create();
    }
}
