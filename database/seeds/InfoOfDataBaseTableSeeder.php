<?php

use Illuminate\Database\Seeder;

class InfoOfDataBaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\InfoOfDataBase::create([
            'numero'      => 1,
            'name_table'   => 'Prestamos'
        ]);

        App\InfoOfDataBase::create([
            'numero'      => 2,
            'name_table'   => 'Prestamos desde Web'
        ]);
        
    }
}
