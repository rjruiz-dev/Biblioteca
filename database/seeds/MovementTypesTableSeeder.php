<?php

use Illuminate\Database\Seeder;

class MovementTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Movement_type::create([           
            'book_status_priv'           => 'PRESTADO',
            'book_status_public'           => 'PRESTADO',
            'description_movement'  => 'PRESTAMO',
            'view'  => 0,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'RENOVADO',
            'book_status_public'           => 'PRESTADO',
            'description_movement'  => 'RENOVACION',
            'view'  => 0,
            ]);
        
        App\Movement_type::create([            
            'book_status_priv'           => 'DISPONIBLE',
            'book_status_public'           => 'DISPONIBLE',
            'description_movement'  => 'DEVOLUCION',
            'view'  => 0,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'BAJA',
            'book_status_public'           => 'BAJA',
            'description_movement'  => 'EN BAJA',
            'view'  => 1,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'MANTENIMIENTO',
            'book_status_public'           => 'MANTENIMIENTO',
            'description_movement'  => 'MANTENIMIENTO',
            'view'  => 1,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'DISPONIBLE',
            'book_status_public'           => 'DISPONIBLE',
            'description_movement'  => 'DISPONIBILIDAD',
            'view'  => 1,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'RESERVADO',
            'book_status_public'           => 'RESERVADO',
            'description_movement'  => 'SOLICITUD',
            'view'  => 1,
        ]);

        App\Movement_type::create([            
            'book_status_priv'           => 'DISPONIBLE',
            'book_status_public'           => 'DISPONIBLE',
            'description_movement'  => 'RECHAZADO',
            'view'  => 0, 
        ]);
    }
}
