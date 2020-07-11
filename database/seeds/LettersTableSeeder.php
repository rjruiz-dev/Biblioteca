<?php

use Illuminate\Database\Seeder;

class LettersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generate_letter::class, 2)->create();       
    }
}
