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
            'name_table'   => 'Prestamos Vigentes'
        ]);

        App\InfoOfDataBase::create([
            'numero'      => 2,
            'name_table'   => 'Prestamos Historico'
        ]);

        App\infoOfDataBase::create([
            'numero'      => 3,
            'name_table'   => 'Solicitudes Vigentes'
        ]);

        App\infoOfDataBase::create([
            'numero'      => 4,
            'name_table'   => 'Solicitudes Historico'
        ]); 

        App\infoOfDataBase::create([
            'numero'      => 5,
            'name_table'   => 'Público Adecuado' 
        ]);

        App\infoOfDataBase::create([
            'numero'      => 6,
            'name_table'   => 'Materias' 
        ]); 

        App\infoOfDataBase::create([
            'numero'      => 7,
            'name_table'   => 'Maestro de Referencias' 
        ]); 

        App\infoOfDataBase::create([
            'numero'      => 8,
            'name_table'   => 'Documentos con Sinopsis' 
        ]); 

        App\infoOfDataBase::create([
            'numero'      => 9,
            'name_table'   => 'Cursos' 
        ]); 
        App\infoOfDataBase::create([
            'numero'      => 10,
            'name_table'   => 'Formatos' 
        ]);
        App\infoOfDataBase::create([
            'numero'      => 11,
            'name_table'   => 'Generos' 
        ]);
        App\infoOfDataBase::create([
            'numero'      => 12,
            'name_table'   => 'Idiomas' 
        ]);
        App\infoOfDataBase::create([
            'numero'      => 13,
            'name_table'   => 'Documentos' 
        ]);
        App\infoOfDataBase::create([
            'numero'      => 14,
            'name_table'   => 'Socios de la Biblioteca' 
        ]);
        App\infoOfDataBase::create([
            'numero'      => 15,
            'name_table'   => 'Referencias en Documentos' 
        ]);
        
    }
}
