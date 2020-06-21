<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdecuaciesTableSeeder::class);
        $this->call(LenguagesTableSeeder::class);      
        $this->call(Document_TypesTableSeeder::class);        
        $this->call(CreatorsTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(StatusTableSeeder::class);        
        $this->call(UsersTableSeeder::class);
    }
}
