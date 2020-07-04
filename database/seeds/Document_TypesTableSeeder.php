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
        factory(App\Document_type::class, 5)->create();
    }
}