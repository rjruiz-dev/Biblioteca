<?php

use Illuminate\Database\Seeder;

class StatusDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\StatusDocument::create([           
            'name_status'    => 'Activo'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Baja'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Desidherata'
        ]);
    }
}
