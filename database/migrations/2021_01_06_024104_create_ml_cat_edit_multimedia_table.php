<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatEditMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_edit_multimedia', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
           
            $table->string('compl_editar')->nullable();
            $table->string('compl_area_de_titulo')->nullable();
            $table->string('compl_area_de_edicion')->nullable();
            $table->string('compl_area_de_contenidos')->nullable();
        
           $table->string('cuerpo_titulo')->nullable(); 
           $table->string('ph_cuerpo_titulo')->nullable();  
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
           $table->string('cuerpo_adecuado_para')->nullable();
           $table->string('ph_cuerpo_adecuado_para')->nullable();
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
           $table->string('cuerpo_duracion')->nullable(); 
           $table->string('ph_cuerpo_duracion')->nullable();
           $table->string('cuerpo_tamanio')->nullable();
           $table->string('ph_cuerpo_tamanio')->nullable(); 
           $table->string('cuerpo_coleccion')->nullable(); 
           $table->string('ph_cuerpo_coleccion')->nullable();
           $table->string('cuerpo_ubicacion')->nullable(); 
           $table->string('ph_cuerpo_ubicacion')->nullable();
           $table->string('cuerpo_obsevacion')->nullable();
           $table->string('ph_cuerpo_obsevacion')->nullable();
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
        Schema::dropIfExists('ml_cat_edit_multimedia');
    }
}
