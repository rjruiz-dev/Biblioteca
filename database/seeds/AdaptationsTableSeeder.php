<?php

use Illuminate\Database\Seeder;

class AdaptationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Adaptations::create([
            'adaptation_name'      => 'SI',
        ]);

        App\Adaptations::create([
            'adaptation_name'      => 'NO',
        ]);
    }
}
