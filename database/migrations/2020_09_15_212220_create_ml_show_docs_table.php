<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlShowDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_show_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('imagen_de_portada')->nullable();
            $table->string('idioma')->nullable();
            $table->string('disponible_desde')->nullable();
            $table->string('adecuado_para')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('solicitar_prestamo')->nullable();
            $table->string('valoracion')->nullable();
            $table->string('anio')->nullable();
            $table->string('subtipo_de_documento')->nullable();
            $table->string('titulo')->nullable();
            $table->string('autor')->nullable();
            $table->string('sinopsis')->nullable();
            $table->string('titulo_original')->nullable();
            $table->string('editorial')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('genero')->nullable();
            $table->string('duracion')->nullable();
            $table->string('formato')->nullable();
            
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
        Schema::dropIfExists('ml_show_docs');
    }
}
