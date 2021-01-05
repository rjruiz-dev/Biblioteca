<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatEditBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_edit_books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('many_lenguages_id')->nullable()->unsigned();
            
            $table->string('compl_editar')->nullable();
            $table->string('compl_area_de_titulo')->nullable();
            $table->string('compl_area_de_edicion')->nullable();
            $table->string('compl_area_de_contenidos')->nullable();

            $table->string('cuerpo_tipo_de_libro')->nullable();
            $table->string('ph_cuerpo_tipo_de_libro')->nullable(); 
            $table->string('cuerpo_titulo')->nullable();
            $table->string('ph_cuerpo_titulo')->nullable();
            $table->string('cuerpo_tema_portada')->nullable();
            $table->string('ph_cuerpo_tema_portada')->nullable();
            $table->string('cuerpo_volumen_numero_fecha')->nullable();
            $table->string('ph_cuerpo_volumen_numero_fecha')->nullable();
            $table->string('cuerpo_subtitulo')->nullable();
            $table->string('ph_cuerpo_subtitulo')->nullable();
            $table->string('cuerpo_autor')->nullable();
            $table->string('ph_cuerpo_autor')->nullable();
            $table->string('cuerpo_segundo_autor')->nullable();
            $table->string('ph_cuerpo_segundo_autor')->nullable();
            $table->string('cuerpo_tercer_autor')->nullable();
            $table->string('ph_cuerpo_tercer_autor')->nullable();
            $table->string('cuerpo_titulo_original')->nullable();
            $table->string('ph_cuerpo_titulo_original')->nullable();
            $table->string('cuerpo_traductor')->nullable();
            $table->string('ph_cuerpo_traductor')->nullable();
            $table->string('cuerpo_isbn')->nullable();
            $table->string('ph_cuerpo_isbn')->nullable();
            $table->string('cuerpo_adquirido')->nullable();
            $table->string('ph_cuerpo_adquirido')->nullable();
            $table->string('cuerpo_genero')->nullable();
            $table->string('ph_cuerpo_genero')->nullable();
            $table->string('cuerpo_adecuado_para')->nullable();
            $table->string('ph_cuerpo_adecuado_para')->nullable();
            $table->string('cuerpo_periodicidad')->nullable();
            $table->string('ph_cuerpo_periodicidad')->nullable();
            $table->string('cuerpo_issn')->nullable();
            $table->string('ph_cuerpo_issn')->nullable();
            $table->string('cuerpo_otros')->nullable();
            $table->string('ph_cuerpo_otros')->nullable();
            $table->string('cuerpo_siglas_autor')->nullable();
            $table->string('ph_cuerpo_siglas_autor')->nullable();
            $table->string('cuerpo_siglas_titulo')->nullable();
            $table->string('ph_cuerpo_siglas_titulo')->nullable();
            $table->string('cuerpo_cdu')->nullable();
            $table->string('ph_cuerpo_cdu')->nullable();
            $table->string('cuerpo_valoracion')->nullable();
            $table->string('ph_cuerpo_valoracion')->nullable();
            $table->string('cuerpo_estado')->nullable();
            $table->string('ph_cuerpo_estado')->nullable();
            $table->string('cuerpo_publicado_en')->nullable();
            $table->string('ph_cuerpo_publicado_en')->nullable();
            $table->string('cuerpo_editorial')->nullable();
            $table->string('ph_cuerpo_editorial')->nullable();
            $table->string('cuerpo_anio_de_publicacion')->nullable();
            $table->string('ph_cuerpo_anio_de_publicacion')->nullable();
            $table->string('cuerpo_edicion')->nullable();
            $table->string('ph_cuerpo_edicion')->nullable();
            $table->string('cuerpo_volumenes')->nullable();
            $table->string('ph_cuerpo_volumenes')->nullable();
            $table->string('cuerpo_numero_de_paginas')->nullable();
            $table->string('ph_cuerpo_numero_de_paginas')->nullable();
            $table->string('cuerpo_tamanio')->nullable();
            $table->string('ph_cuerpo_tamanio')->nullable();
            $table->string('cuerpo_coleccion')->nullable();
            $table->string('ph_cuerpo_coleccion')->nullable();
            $table->string('cuerpo_ubicacion')->nullable();
            $table->string('ph_cuerpo_ubicacion')->nullable();
            $table->string('cuerpo_idioma')->nullable();
            $table->string('ph_cuerpo_idioma')->nullable();
            $table->string('cuerpo_referencia')->nullable();
            $table->string('ph_cuerpo_referencia')->nullable();
            $table->string('cuerpo_observacion')->nullable();
            $table->string('ph_cuerpo_observacion')->nullable();
            $table->string('cuerpo_nota')->nullable();
            $table->string('ph_cuerpo_nota')->nullable();
            $table->string('cuerpo_fotografia')->nullable();
            $table->string('ph_cuerpo_fotografia')->nullable();
            $table->string('cuerpo_sinopsis')->nullable();
            $table->string('ph_cuerpo_sinopsis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_cat_edit_books');
    }
}
