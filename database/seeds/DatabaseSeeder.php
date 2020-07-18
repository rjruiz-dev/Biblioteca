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
        $this->call(PeriodicitiesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(Generate_referenceTableSeeder::class);
        $this->call(AdecuaciesTableSeeder::class);
        $this->call(LenguagesTableSeeder::class);                 
        $this->call(Document_TypesTableSeeder::class);
        $this->call(Document_SubtypeTableSeeder::class);        
        $this->call(CreatorsTableSeeder::class);
        $this->call(Generate_bookTableSeeder::class);
        $this->call(Generate_musicTableSeeder::class);  
        $this->call(Generate_multimediaTableSeeder::class);    
        $this->call(Generate_moviesTableSeeder::class);
        $this->call(AdaptationsTableSeeder::class);  
        $this->call(PhotographyMoviesTableSeeder::class);  
        $this->call(CoursesTableSeeder::class);
        $this->call(Movement_TypesTableSeeder::class);  
        $this->call(DocumentsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        
        $this->call(FormatsTableSeeder::class);
        // $this->call(MultimediasTableSeeder::class);
        // $this->call(MusicsTableSeeder::class);
        $this->call(StatusTableSeeder::class);        
        $this->call(UsersTableSeeder::class);
    }
}
