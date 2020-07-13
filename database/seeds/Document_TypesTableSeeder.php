<?php

use Illuminate\Database\Seeder;

class Document_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Document_type::class, 5)->create();

        App\Document_type::create([
            'document_description'      => 'Musica', // 1 
        ]);
        App\Document_type::create([
            'document_description'      => 'Cine', // 2
        ]);
        App\Document_type::create([
            'document_description'      => 'Libro', // 3
        ]);
        App\Document_type::create([
            'document_description'      => 'Multimedia', // 4
        ]);
        App\Document_type::create([
            'document_description'      => 'Fotografia', // 5
        ]);     
    }
}
