<?php

use Illuminate\Database\Seeder;

class PeriodicitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Periodicity::create([
            'periodicity_name'      => 'Mensual',
        ]);
        App\Periodicity::create([
            'periodicity_name'      => 'Quincenal',
        ]);
        App\Periodicity::create([
            'periodicity_name'      => 'Semanal',
        ]);
        App\Periodicity::create([
            'periodicity_name'      => 'Anual',
        ]);
    }
}
