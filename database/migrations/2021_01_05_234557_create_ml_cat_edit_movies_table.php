<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatEditMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_edit_movies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
           
            $table->string('cuerpo_desidherata')->nullable();
            $table->string('compl_area_de_titulo')->nullable();
            $table->string('compl_area_de_edicion')->nullable();
            $table->string('compl_area_de_contenidos')->nullable();
            $table->string('compl_btn_cancelar')->nullable();
            $table->string('compl_btn_guardar')->nullable();

           $table->string('cuerpo_titulo')->nullable();
           $table->string('ph_cuerpo_titulo')->nullable(); 
           $table->string('cuerpo_subtitulo')->nullable(); 
           $table->string('ph_cuerpo_subtitulo')->nullable();
           $table->string('cuerpo_director')->nullable();
           $table->string('ph_cuerpo_director')->nullable(); 
           $table->string('cuerpo_reparto')->nullable();
           $table->string('ph_cuerpo_reparto')->nullable(); 
           $table->string('cuerpo_titulo_original')->nullable();
           $table->string('ph_cuerpo_titulo_original')->nullable(); 
           $table->string('cuerpo_adaptacion')->nullable();
           $table->string('ph_cuerpo_adaptacion')->nullable();
           $table->string('cuerpo_guion')->nullable();
           $table->string('ph_cuerpo_guion')->nullable(); 
           $table->string('cuerpo_contenido_especifico')->nullable();
           $table->string('ph_cuerpo_contenido_especifico')->nullable();
           $table->string('cuerpo_adquirido')->nullable();
           $table->string('ph_cuerpo_adquirido')->nullable(); 
           $table->string('cuerpo_adecuado_para')->nullable(); 
           $table->string('ph_cuerpo_adecuado_para')->nullable(); 
           $table->string('cuerpo_genero')->nullable();
           $table->string('ph_cuerpo_genero')->nullable(); 
           $table->string('cuerpo_siglas_director')->nullable();
           $table->string('ph_cuerpo_siglas_director')->nullable(); 
           $table->string('cuerpo_siglas_titulo')->nullable();
           $table->string('ph_cuerpo_siglas_titulo')->nullable(); 
           $table->string('cuerpo_cdu')->nullable();
           $table->string('ph_cuerpo_cdu')->nullable(); 
           $table->string('cuerpo_valoracion')->nullable();
           $table->string('ph_cuerpo_valoracion')->nullable();
           $table->string('cuerpo_estado')->nullable();
           $table->string('ph_cuerpo_estado')->nullable(); 
           $table->string('cuerpo_nacionalidad')->nullable();
           $table->string('ph_cuerpo_nacionalidad')->nullable(); 
           $table->string('cuerpo_productora')->nullable(); 
           $table->string('ph_cuerpo_productora')->nullable();
           $table->string('cuerpo_anio_de_publicacion')->nullable();
           $table->string('ph_cuerpo_anio_de_publicacion')->nullable(); 
           $table->string('cuerpo_fotografia')->nullable(); 
           $table->string('ph_cuerpo_fotografia')->nullable();
           $table->string('cuerpo_duracion')->nullable();
           $table->string('ph_cuerpo_duracion')->nullable();
           $table->string('cuerpo_formato')->nullable();
           $table->string('ph_cuerpo_formato')->nullable(); 
           $table->string('cuerpo_distribuidora')->nullable(); 
           $table->string('ph_cuerpo_distribuidora')->nullable(); 
           $table->string('cuerpo_ubicacion')->nullable();
           $table->string('ph_cuerpo_ubicacion')->nullable(); 
           $table->string('cuerpo_premios')->nullable();
           $table->string('ph_cuerpo_premios')->nullable();
           $table->string('cuerpo_notas')->nullable();
           $table->string('ph_cuerpo_notas')->nullable(); 
           $table->string('cuerpo_idioma')->nullable();
           $table->string('ph_cuerpo_idioma')->nullable();
           $table->string('cuerpo_referencia')->nullable();
           $table->string('ph_cuerpo_referencia')->nullable(); 
           $table->string('cuerpo_imagen')->nullable();
           $table->string('ph_cuerpo_imagen')->nullable(); 
           $table->string('cuerpo_sinopsis')->nullable();
           $table->string('ph_cuerpo_sinopsis')->nullable();

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
        Schema::dropIfExists('ml_cat_edit_movies');
    }
}
