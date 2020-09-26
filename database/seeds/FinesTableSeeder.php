<?php

use Illuminate\Database\Seeder;

class FinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Fine::create([
            'fine_description'      => 'Economica',
            'unit'      => 1
            ]);

            App\Fine::create([
                'fine_description'      => 'Suspension',
                'unit'      => 1 
                ]);

        
    }
}
