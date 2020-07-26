<?php

use Illuminate\Database\Seeder;

class MovementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Movement_type::create([           
            'book_status'           => 'PRESTADO',
            'description_movement'  => 'PRESTADO',
        ]);

        App\Movement_type::create([            
            'book_status'           => 'PRESTADO',
            'description_movement'  => 'RENOVADO',
        ]);
        
        App\Movement_type::create([            
            'book_status'           => 'DISPONIBLE',
            'description_movement'  => 'DEVUELTO',
        ]);
    }
}
