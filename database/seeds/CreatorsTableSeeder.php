<?php

use Illuminate\Database\Seeder;

class CreatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Creator::unguard();
        
        App\Creator::create([
            'id'      => 100,
            'document_types_id'      => 100,
            'creator_name'      => 'Sin Autor desde Rebecca',
            ]);
    }
}
