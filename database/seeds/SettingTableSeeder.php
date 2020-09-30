<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create([ 
            'library_name'  => 'Tu Biblioteca',
            'library_email' => 'TuEmail@gmail.com',
            'library_phone' => '234-5677234',
            'language'      => 'Español',
            'fines_id'      => 1,
            'logo'          => 'Library-default.jpg',
            'street'        => 'Tu Direccion 1234',
            'city'          => 'Tu Ciudad',
            'province'      => 'Tu Provincia',
            'postal_code'   => 'Tu Codigo postal', 
            'country'       => 'Tu pais',
            'child_age'     => '12',
            'adult_age'     => '18',
            'color'         => '#f1ca19',
        ]);
       
    }
}
