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
        App\Adaptation::unguard();

        App\Adaptation::create([
            'adaptation_name'      => 'SI',
        ]);

        App\Adaptation::create([
            'adaptation_name'      => 'NO',
        ]);

        App\Adaptation::create([
            'id'      => 100,
            'adaptation_name'      => 'Sin Adaptación desde Rebecca',
        ]);
    }
}
