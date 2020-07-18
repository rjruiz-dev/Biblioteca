<?php

use Illuminate\Database\Seeder;

class Movement_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Movement_type::create([
            'description_movement'      => 'PRESTADO',
            'book_status'      => '-',
        ]);

        App\Movement_type::create([
            'description_movement'      => 'DEVUELTO',
            'book_status'      => '-',
        ]);
    }
}
