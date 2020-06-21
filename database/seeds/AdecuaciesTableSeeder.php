<?php

use Illuminate\Database\Seeder;

class AdecuaciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Adequacy::class, 2)->create();
    }
}
