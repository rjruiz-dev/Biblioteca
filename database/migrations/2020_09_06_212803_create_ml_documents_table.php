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
            $table->integer('cdu')->nullable();            
            $table->integer('adecuacion')->nullable();
            $table->integer('idioma')->nullable();
            $table->integer('tipo_doc')->nullable();
            $table->integer('subtipo_doc')->nullable();
            $table->integer('creador')->nullable();
            $table->string('titulo')->nullable(); 
            $table->string('titulo_original')->nullable();
            $table->timestamp('adquirido')->nullable();        
            $table->string('siglas_autor')->nullable();          
            $table->string('siglas_titulo')->nullable();           
            $table->string('valoracion')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('publicado')->nullable();
            $table->string('hecho_por')->nullable();
            $table->timestamp('año')->nullable();
            $table->string('volumen')->nullable();
            $table->string('cant_generica')->nullable();
            $table->string('coleccion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->mediumText('observacion')->nullable();
            $table->string('nota')->nullable();
            $table->mediumText('sinopsis')->nullable();
            $table->string('foto')->nullable();

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
