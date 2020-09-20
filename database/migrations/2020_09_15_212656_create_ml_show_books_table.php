<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlShowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_show_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('tema_de_portada')->nullable();
            $table->string('sobre_el_documento')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('otros_autores')->nullable();
            $table->string('publicado_en')->nullable();
            $table->string('detalles_del_documento')->nullable();
            $table->string('volumen')->nullable();
            $table->string('numero_de_paginas')->nullable();
            $table->string('tamanio')->nullable();
            

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
        Schema::dropIfExists('ml_show_books');
    }
}
