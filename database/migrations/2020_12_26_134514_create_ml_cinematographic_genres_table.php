<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCinematographicGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cinematographic_genres', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_gc')->nullable();
            $table->string('subtitulo_gc')->nullable();
            $table->string('btn_crear_gc')->nullable();
            $table->string('dt_id_gc')->nullable();
            $table->string('dt_gc')->nullable();          
            $table->string('dt_agregado_gc')->nullable();         
            $table->string('dt_acciones_gc')->nullable();           
            $table->string('mod_subtitulo_gc')->nullable();           
            $table->string('cam_gc')->nullable(); 

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
        Schema::dropIfExists('ml_cinematographic_genres');
    }
}
