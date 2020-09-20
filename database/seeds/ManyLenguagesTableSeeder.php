<?php

use Illuminate\Database\Seeder;

class ManyLenguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ManyLenguages::create([
            'lenguage_description'      => 'Español',
            'baja'      => 0,
            ]);
    }
}
