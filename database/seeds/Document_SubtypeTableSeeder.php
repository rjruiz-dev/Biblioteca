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
        factory(App\Document_subtype::class, 3)->create();
    }
}
