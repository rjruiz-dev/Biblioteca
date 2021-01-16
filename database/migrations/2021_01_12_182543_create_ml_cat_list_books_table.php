<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatListBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_list_books', function (Blueprint $table) {
            $table->increments('id');

    $table->integer('many_lenguages_id')->nullable()->unsigned();
           
      $table->string('book_text_titulo')->nullable();
      $table->string('book_text_inicio')->nullable();
      
      $table->string('book_ph_referencia')->nullable();
      $table->string('book_ph_materia')->nullable();
      $table->string('book_ph_adecuacion')->nullable();
      $table->string('book_ph_genero')->nullable();
      
      $table->string('book_btn_buscar')->nullable();
      $table->string('book_btn_crear')->nullable();
      
      $table->string('book_dt_id')->nullable();
      $table->string('book_dt_titulo')->nullable();
      $table->string('book_dt_subtipo')->nullable();
      $table->string('book_dt_portada')->nullable();
      $table->string('book_dt_genero')->nullable();
      $table->string('book_dt_idioma')->nullable();
      $table->string('book_dt_estado')->nullable();
      $table->string('book_dt_agregado')->nullable();
      $table->string('book_dt_acciones')->nullable();

      $table->string('movie_text_titulo')->nullable();
      $table->string('movie_text_inicio')->nullable();
      
      $table->string('movie_btn_buscar')->nullable();
      $table->string('movie_btn_crear')->nullable();
      
      $table->string('movie_ph_referencia')->nullable();
      $table->string('movie_ph_materia')->nullable();
      $table->string('movie_ph_adecuacion')->nullable();
      $table->string('movie_ph_genero')->nullable();
      
      $table->string('movie_dt_id')->nullable();
      $table->string('movie_dt_titulo')->nullable();
      $table->string('movie_dt_genero')->nullable();
      $table->string('movie_dt_portada')->nullable();
      $table->string('movie_formato')->nullable();
      $table->string('movie_dt_idioma')->nullable();
      $table->string('movie_dt_estado')->nullable();
      $table->string('movie_dt_agregado')->nullable();
      $table->string('movie_dt_acciones')->nullable();

      $table->string('music_text_titulo')->nullable();
      $table->string('music_text_inicio')->nullable();
      
      $table->string('music_btn_buscar')->nullable();
      $table->string('music_btn_crear')->nullable();
      
      $table->string('music_ph_referencia')->nullable();
      $table->string('music_ph_materia')->nullable();
      $table->string('music_ph_adecuacion')->nullable();
      $table->string('music_ph_genero')->nullable();
      
      $table->string('music_dt_id')->nullable();
      $table->string('music_dt_titulo')->nullable();
      $table->string('music_dt_subtipo')->nullable();
      $table->string('music_dt_portada')->nullable();
      $table->string('music_dt_genero')->nullable();
      $table->string('music_dt_idioma')->nullable();
      $table->string('music_dt_estado')->nullable();
      $table->string('music_dt_agregado')->nullable();
      $table->string('music_dt_acciones')->nullable();


      $table->string('fotografia_text_titulo')->nullable();
      $table->string('fotografia_text_inicio')->nullable();
      
      $table->string('fotografia_btn_buscar')->nullable();
      $table->string('fotografia_btn_crear')->nullable();
      
      $table->string('fotografia_ph_referencia')->nullable();
      $table->string('fotografia_ph_materia')->nullable();
      $table->string('fotografia_ph_adecuacion')->nullable();
      $table->string('fotografia_ph_genero')->nullable();
      
      $table->string('fotografia_dt_id')->nullable();
      $table->string('fotografia_dt_titulo')->nullable();
      $table->string('fotografia_dt_subtipo')->nullable();
      $table->string('fotografia_dt_portada')->nullable();
      $table->string('fotografia_dt_formato')->nullable();
      $table->string('fotografia_dt_estado')->nullable();
      $table->string('fotografia_dt_agregado')->nullable();
      $table->string('fotografia_dt_acciones')->nullable();

      $table->string('multimedias_text_titulo')->nullable();
      $table->string('multimedias_text_inicio')->nullable();
      
      $table->string('multimedias_btn_buscar')->nullable();
      $table->string('multimedias_btn_crear')->nullable();
      
      $table->string('multimedias_ph_referencia')->nullable();
      $table->string('multimedias_ph_materia')->nullable();
      $table->string('multimedias_ph_adecuacion')->nullable();
      $table->string('multimedias_ph_genero')->nullable();
      
      $table->string('multimedias_dt_id')->nullable();
      $table->string('multimedias_dt_titulo')->nullable();
      $table->string('multimedias_dt_portada')->nullable();
      $table->string('multimedias_dt_estado')->nullable();
      $table->string('multimedias_dt_agregado')->nullable();
      $table->string('multimedias_dt_acciones')->nullable();

            $table->timestamps();

            $table->foreign('many_lenguages_id')->references('id')->on('many_lenguages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_cat_list_books');
    }
}
