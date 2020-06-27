<?php

use Illuminate\Database\Seeder;

class Generate_bookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generate_book::class, 6)->create();
    }
}
