<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_movies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            // $table->string('documents_id')->nullable();
            $table->string('genero')->nullable();
            $table->string('formato')->nullable();
            $table->string('adaptacion')->nullable();
            $table->string('fotografia_tipo')->nullable();
            $table->string('subtitulo')->nullable(); 
            $table->string('guion')->nullable();
            $table->string('contenido_especifico')->nullable();        
            $table->string('premios')->nullable();
            $table->string('distribuidor')->nullable();

            $table->foreign('many_lenguages_id')->references('id')->on('many_lenguages')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_movies');
    }
}
