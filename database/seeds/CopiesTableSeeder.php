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
            'documents_id'    => 1
        ]);

        App\Copy::create([            
            'documents_id'    => 2
        ]);
        
        App\Copy::create([            
            'documents_id'    => 3
        ]);
    }
}
