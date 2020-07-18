<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Course::create([
            'course_name'      => 'Curso 1',
        ]);

        App\Course::create([
            'course_name'      => 'Curso 5',
        ]);

        App\Course::create([
            'course_name'      => 'Curso 3',
        ]);

        App\Course::create([
            'course_name'      => 'Curso 2',
        ]);

        
    }
}
