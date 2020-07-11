<?php

use Illuminate\Database\Seeder;

class Document_SubtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Document_subtype::class, 5)->create();

            // 1 referencia a musica
        App\Document_subtype::create([
            'subtype_name'      => 'Culta',
            'document_types_id'      => 1,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'Popular',
            'document_types_id'      => 1,
        ]);

            // 3 referencia a libros
        App\Document_subtype::create([
            'subtype_name'      => 'Otros',
            'document_types_id'      => 3,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'Publ. Periodica',
            'document_types_id'      => 3,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'literatura',
            'document_types_id'      => 3,
        ]);

        // 5 referencia a fotografia

        App\Document_subtype::create([
            'subtype_name'      => 'Diapositiva',
            'document_types_id'      => 5,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'Catalogo',
            'document_types_id'      => 5,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'Negativos',
            'document_types_id'      => 5,
        ]);
        App\Document_subtype::create([
            'subtype_name'      => 'Sin SubTipo',
        ]);
    
    }
}
