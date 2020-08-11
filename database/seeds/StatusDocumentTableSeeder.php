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
            'name_status'    => 'Activo',
            'color'    => 'badge badge-success'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Baja',
            'color'    => 'badge badge-danger'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Desidherata',
            'color'    => 'badge badge-warning'
        ]);
    }
}
