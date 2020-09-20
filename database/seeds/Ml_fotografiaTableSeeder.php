<?php

use Illuminate\Database\Seeder;

class Ml_fotografiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ml_show_fotografia::create([
            'many_lenguages_id'      => 1,
            'detalles_de_la_fotografia'      => 'detalles_de_la_fotografia',
            'notas'      => 'notas',
            'observaciones'      => 'observaciones',
            ]);
    }
}
