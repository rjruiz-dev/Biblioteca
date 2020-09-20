<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlShowMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_show_movies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
            
            $table->string('dirigido_por')->nullable();
            $table->string('sobre_la_pelicula')->nullable();
            $table->string('reparto')->nullable();
            $table->string('productora')->nullable();
            $table->string('distribuidora')->nullable();
            $table->string('detalles_de_la_pelicula')->nullable();
            $table->string('fotografia')->nullable();

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
        Schema::dropIfExists('ml_show_movies');
    }
}
