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
        // {{ route('admin.books.index') }}
        App\Document_type::unguard();

        App\Document_type::create([
            'document_description'      => 'Musica', // 1 
            'route'      => 'admin.music.index'
            ]);
        App\Document_type::create([
            'document_description'      => 'Cine', // 2
            'route'      => 'admin.movies.index'
        ]);
        App\Document_type::create([
            'document_description'      => 'Libro', // 3
            'route'      => 'admin.books.index'
        ]);
        App\Document_type::create([
            'document_description'      => 'Multimedia', // 4
            'route'      => 'admin.multimedias.index'
        ]);
        App\Document_type::create([
            'document_description'      => 'Fotografia', // 5
            'route'      => 'admin.photographs.index' 
        ]);    
        App\Document_type::create([
            'id'      => 100,
            'document_description'      => 'import rebecca', // 100
            'route'      => 'aaa' 
        ]); 
    }
}
