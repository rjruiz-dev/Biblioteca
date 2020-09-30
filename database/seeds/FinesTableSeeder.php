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
            'label'      => '$',
            'unit'      => 1
            ]);

            App\Fine::create([
                'fine_description'      => 'Suspension',
                'label'      => 'dias',
                'unit'      => 1 
                ]);

        
    }
}
