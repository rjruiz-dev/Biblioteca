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
        $this->call(Document_SubtypeTableSeeder::class);        
        $this->call(CreatorsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(Generate_bookTableSeeder::class);
        $this->call(Generate_musicTableSeeder::class); 
        $this->call(Generate_filmTableSeeder::class); 
        $this->call(Generate_formatTableSeeder::class);
        $this->call(AdaptationsTableSeeder::class);  
        $this->call(PhotographyMoviesTableSeeder::class);  
        $this->call(Generate_referenceTableSeeder::class);
        $this->call(LettersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(PeriodicitiesTableSeeder::class);

        $this->call(MovementTypesTableSeeder::class);
        $this->call(StatusDocumentTableSeeder::class);    
        // $this->call(DocumentsTableSeeder::class);
        // $this->call(CopiesTableSeeder::class);
        $this->call(StatusTableSeeder::class);         
        $this->call(UsersTableSeeder::class);
        // $this->call(BookMovementTableSeeder::class);   
        // $this->call(BooksTableSeeder::class);
        // $this->call(MusicTableSeeder::class);
        // $this->call(MoviesTableSeeder::class);
        // $this->call(PhotographyTableSeeder::class);
        // $this->call(PublicationsTableSeeder::class); 
        // $this->call(Generate_bookTableSeeder::class);           
        // $this->call(StatusTableSeeder::class);        
        // $this->call(UsersTableSeeder::class);
        $this->call(InfoOfDataBaseTableSeeder::class); 
        // $this->call(ManyLenguagesTableSeeder::class); 
        // $this->call(MultiIdiomasTableSeeder::class);
        // $this->call(Ml_bookTableSeeder::class); 
        // $this->call(Ml_multimediaTableSeeder::class);  
        // $this->call(Ml_fotografiaTableSeeder::class);  
        // $this->call(Ml_musicaTableSeeder::class);  
        // $this->call(Ml_abm_docTableSeeder::class);  
        // $this->call(Ml_abm_bookTableSeeder::class);  
        // $this->call(Ml_abm_book_otrosTableSeeder::class);  
        // $this->call(Ml_abm_book_public_periodTableSeeder::class);  
        // $this->call(Ml_abm_book_litTableSeeder::class);  
        // $this->call(Ml_abm_musicTableSeeder::class);  
        // $this->call(Ml_abm_music_cultaTableSeeder::class);  
        // $this->call(Ml_abm_music_popularTableSeeder::class);  
        // $this->call(Ml_abm_multimediaTableSeeder::class);  
        // $this->call(Ml_abm_fotografiaTableSeeder::class);  
        // $this->call(Ml_abm_movieTableSeeder::class);
        $this->call(FinesTableSeeder::class); 
        $this->call(SettingTableSeeder::class);
          
        
    }
}
