<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatEditMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_edit_musics', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
           
            $table->string('compl_editar')->nullable();
            $table->string('compl_area_de_titulo')->nullable();
            $table->string('compl_area_de_edicion')->nullable();
            $table->string('compl_area_de_contenidos')->nullable();
            
            $table->string('cuerpo_tipo_de_musica')->nullable();
            $table->string('cuerpo_titulo_de_la_obra')->nullable();
            $table->string('cuerpo_titulo')->nullable();
            $table->string('cuerpo_subtitulo')->nullable();
            $table->string('cuerpo_artista')->nullable();
            $table->string('cuerpo_otros_artistas')->nullable();
            $table->string('cuerpo_musica')->nullable();
            $table->string('cuerpo_titulo_original')->nullable();
            $table->string('cuerpo_titulo_del_disco')->nullable();
            $table->string('cuerpo_compositor')->nullable();
            $table->string('cuerpo_director')->nullable();
            $table->string('cuerpo_orquesta')->nullable();
            $table->string('cuerpo_solista')->nullable();
            $table->string('cuerpo_productor')->nullable();
            $table->string('cuerpo_adquirido')->nullable();
            $table->string('cuerpo_adecuado_para')->nullable();
            $table->string('cuerpo_genero')->nullable();
            $table->string('cuerpo_siglas_compositor')->nullable();
            $table->string('cuerpo_siglas_titulo')->nullable();
            $table->string('cuerpo_cdu')->nullable();
            $table->string('cuerpo_valoracion')->nullable();
            $table->string('cuerpo_estado')->nullable();
            $table->string('cuerpo_editado_en')->nullable();
            $table->string('cuerpo_sello_discografico')->nullable();
            $table->string('cuerpo_anio_de_publicacion')->nullable();
            $table->string('cuerpo_fotografia')->nullable();
            $table->string('cuerpo_volumenes')->nullable();
            $table->string('cuerpo_duracion')->nullable();
            $table->string('cuerpo_formato')->nullable();
            $table->string('cuerpo_coleccion')->nullable();
            $table->string('cuerpo_ubicacion')->nullable();
            $table->string('cuerpo_observacion')->nullable();
            $table->string('cuerpo_notas')->nullable();
            $table->string('cuerpo_idioma')->nullable();
            $table->string('cuerpo_referencia')->nullable();
            $table->string('cuerpo_imagen')->nullable();
            $table->string('cuerpo_sinopsis')->nullable();

            $table->string('ph_cuerpo_tipo_de_musica')->nullable();
            $table->string('ph_cuerpo_titulo_de_la_obra')->nullable();
            $table->string('ph_cuerpo_titulo')->nullable();
            $table->string('ph_cuerpo_subtitulo')->nullable();
            $table->string('ph_cuerpo_artista')->nullable();
            $table->string('ph_cuerpo_otros_artistas')->nullable();
            $table->string('ph_cuerpo_musica')->nullable();
            $table->string('ph_cuerpo_titulo_original')->nullable();
            $table->string('ph_cuerpo_titulo_del_disco')->nullable();
            $table->string('ph_cuerpo_compositor')->nullable();
            $table->string('ph_cuerpo_director')->nullable();
            $table->string('ph_cuerpo_orquesta')->nullable();
            $table->string('ph_cuerpo_solista')->nullable();
            $table->string('ph_cuerpo_productor')->nullable();
            $table->string('ph_cuerpo_adquirido')->nullable();
            $table->string('ph_cuerpo_adecuado_para')->nullable();
            $table->string('ph_cuerpo_genero')->nullable();
            $table->string('ph_cuerpo_siglas_compositor')->nullable();
            $table->string('ph_cuerpo_siglas_titulo')->nullable();
            $table->string('ph_cuerpo_cdu')->nullable();
            $table->string('ph_cuerpo_valoracion')->nullable();
            $table->string('ph_cuerpo_estado')->nullable();
            $table->string('ph_cuerpo_editado_en')->nullable();
            $table->string('ph_cuerpo_sello_discografico')->nullable();
            $table->string('ph_cuerpo_anio_de_publicacion')->nullable();
            $table->string('ph_cuerpo_fotografia')->nullable();
            $table->string('ph_cuerpo_volumenes')->nullable();
            $table->string('ph_cuerpo_duracion')->nullable();
            $table->string('ph_cuerpo_formato')->nullable();
            $table->string('ph_cuerpo_coleccion')->nullable();
            $table->string('ph_cuerpo_ubicacion')->nullable();
            $table->string('ph_cuerpo_observacion')->nullable();
            $table->string('ph_cuerpo_notas')->nullable();
            $table->string('ph_cuerpo_idioma')->nullable();
            $table->string('ph_cuerpo_referencia')->nullable();
            $table->string('ph_cuerpo_imagen')->nullable();
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
        Schema::dropIfExists('ml_cat_edit_musics');
    }
}
