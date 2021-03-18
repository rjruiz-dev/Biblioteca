<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Generate_subjects::unguard();

        App\Generate_subjects::create([
            'id'      => 100,
            'subject_name'      => 'Sin CDU desde Rebecca',
            'cdu'      => 'aaaa',
            ]);   
    }
}
