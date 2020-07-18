<?php

use Illuminate\Database\Seeder;

class PeriodicitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Periodicity::class, 3)->create();
    }
}