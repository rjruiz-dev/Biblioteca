<?php

use Illuminate\Database\Seeder;

class CopiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Copy::create([           
            'documents_id'    => 1,
            'status_copy_id'    => 1,
            'registry_number'    => 4466
        ]);

        App\Copy::create([            
            'documents_id'    => 2,
            'status_copy_id'    => 1,
            'registry_number'    => 4477
        ]);
        
        App\Copy::create([            
            'documents_id'    => 3,
            'status_copy_id'    => 1,
            'registry_number'    => 4488
        ]);
    }
}
