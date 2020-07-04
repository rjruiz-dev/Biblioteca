<?php

use Illuminate\Database\Seeder;

class Generate_musicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generate_musics::class, 6)->create();
    }
}
