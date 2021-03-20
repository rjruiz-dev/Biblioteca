<?php

use Illuminate\Database\Seeder;

class Ml_adequaciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ml_adequacy::create([
            'many_lenguages_id'      => 1,
            'btn_crear_adequacy'      => 'Crear Adecuación',
            'titulo_adequacy'      => 'MANTENIMIENTO DE ADECUACIONES',
            'subtitulo_adequacy'      => 'Listado de Personas Adecuadas',
            'dt_id_adequacy'      => 'ID',
            'dt_adequacy'      => 'Personas Adecuadas',
            'dt_agregado_adequacy'      => 'Agregado',
            'dt_acciones_adequacy'      => 'Acciones',
            'mod_subtitulo_adequacy'      => 'Personas Adecuadas',
            'cam_adequacy'      => 'Adecuación',
            ]);
    }
}
