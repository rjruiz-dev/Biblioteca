<?php

use Illuminate\Database\Seeder;

class BookMovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Book_movement::create([           
            'movement_types_id'    => 7,
            'users_id'    => 3,
            'copies_id'    => 1,
            'courses_id'    => 1,
            'grupo'    => 'A',
            'turno'    => 'T',
            'active'    => 1,
        ]);

        App\Book_movement::create([           
            'movement_types_id'    => 7,
            'users_id'    => 3,
            'copies_id'    => 2,
            'courses_id'    => 1,
            'grupo'    => 'A',
            'turno'    => 'T',
            'active'    => 1,
        ]);

        App\Book_movement::create([           
            'movement_types_id'    => 7,
            'users_id'    => 3,
            'copies_id'    => 1,
            'courses_id'    => 1,
            'grupo'    => 'A',
            'turno'    => 'T',
            'active'    => 1,
        ]);

        App\Book_movement::create([           
            'movement_types_id'    => 7,
            'users_id'    => 3,
            'copies_id'    => 1,
            'courses_id'    => 1,
            'grupo'    => 'A',
            'turno'    => 'T',
            'active'    => 1,
        ]);
    }
}
