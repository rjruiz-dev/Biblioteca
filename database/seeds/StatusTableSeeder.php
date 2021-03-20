<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Statu::class, 3)->create();
        App\Statu::create([
            'state_description'      => 'Pendiente', // 1 
            'color'      => '<span class="label label-warning sm">',
            'view_alta'      => '1', // 1
            'view_edit'      => '0' // 1 
            ]);
        App\Statu::create([
                'state_description'      => 'Rechazado', // 1 
                'color'      => '<span class="label label-danger sm">',
                'view_alta'      => '0', // 1
                'view_edit'      => '0' // 1 
                ]);
        App\Statu::create([
                'state_description'      => 'Activo', // 1 
                'color'      => '<span class="label label-success sm">',
                'view_alta'      => '1', // 1
                'view_edit'      => '1' // 1 
                ]);
        App\Statu::create([
                'state_description'      => 'Inactivo', // 1
                'color'      => '<span class="label label-danger sm">', 
                'view_alta'      => '0', // 1
                'view_edit'      => '1' // 1 
                ]);
        App\Statu::create([
                'state_description'      => 'Permanente', // 1
                'color'      => '<span class="label label-success sm">', 
                'view_alta'      => '0', // 1
                'view_edit'      => '0' // 1 
                ]);
    }
}
