<?php

use Illuminate\Database\Seeder;

class MusicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Music::class, 2)->create();
    }
}
