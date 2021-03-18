<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_documents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('cdu')->nullable();            
            $table->string('adecuacion')->nullable();
            $table->string('idioma')->nullable();
            $table->string('tipo_doc')->nullable();
            $table->string('subtipo_doc')->nullable();
            $table->string('creador')->nullable();
            $table->string('titulo')->nullable(); 
            $table->string('titulo_original')->nullable();
            $table->string('adquirido')->nullable();        
            $table->string('siglas_autor')->nullable();          
            $table->string('siglas_titulo')->nullable();           
            $table->string('valoracion')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('publicado')->nullable();
            $table->string('hecho_por')->nullable();
            $table->string('año')->nullable();
            $table->string('volumen')->nullable();
            $table->string('cant_generica')->nullable();
            $table->string('coleccion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('observacion')->nullable();
            $table->string('nota')->nullable();
            $table->string('sinopsis')->nullable();
            $table->string('foto')->nullable();

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
        Schema::dropIfExists('ml_documents');
    }
}
