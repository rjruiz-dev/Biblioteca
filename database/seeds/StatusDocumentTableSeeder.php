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
      App\StatusDocument::unguard();

      App\StatusDocument::create([           
            'name_status'    => 'Activo',
            'color'    => 'label label-success',
            'view_public'    => 'S'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Baja',
            'color'    => 'label label-danger',
            'view_public'    => 'S'
        ]);
        App\StatusDocument::create([           
            'name_status'    => 'Desidherata',
            'color'    => 'label label-warning',
            'view_public'    => 'S'
        ]);
        App\StatusDocument::create([  
            'id'    => 100,         
            'name_status'    => 'Importado desde Rebecca',
            'color'    => 'aaa',
        ]);
    }
}
