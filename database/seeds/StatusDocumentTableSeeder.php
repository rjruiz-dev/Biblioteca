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
            'color'    => 'label label-success'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Baja',
            'color'    => 'label label-danger'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Desidherata',
            'color'    => 'label label-warning'
        ]);
    }
}
