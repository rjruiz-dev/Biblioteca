<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAbmDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_abm_docs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('area_de_titulo')->nullable();
            $table->string('area_de_edición')->nullable();
            $table->string('area_de_contenidos')->nullable();
            $table->string('cerrar')->nullable();
            $table->string('crear')->nullable();
            $table->string('titulo')->nullable();
            $table->string('subtítulo')->nullable();
            $table->string('autor')->nullable();
            $table->string('segundo_autor')->nullable();
            $table->string('tercer_autor')->nullable();
            $table->string('título_original')->nullable();
            $table->string('traductor')->nullable();
            $table->string('Isbn')->nullable();
            $table->string('adquirido')->nullable();
            $table->string('adecuado_para')->nullable();
            $table->string('siglas_autor')->nullable();
            $table->string('siglas_titulo')->nullable();
            $table->string('cdu')->nullable();
            $table->string('valoración')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('contenido_sinopsis_o_indice')->nullable();
            $table->string('publicado_en')->nullable();
            $table->string('anio_de_publicación')->nullable();
            $table->string('edicion')->nullable();
            $table->string('tamanio')->nullable();
            $table->string('volumenes')->nullable();
            $table->string('coleccion')->nullable();
            $table->string('editorial')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('idioma')->nullable();
            $table->string('referencia')->nullable();
            $table->string('observacion')->nullable();
            $table->string('genero')->nullable();
            $table->string('editado_en')->nullable();
            $table->string('sello_discografico')->nullable();
            $table->string('fotografia')->nullable();
            $table->string('duracion')->nullable();
            $table->string('formato')->nullable();
            $table->string('director')->nullable();
            $table->string('plh_autor')->nullable();
            $table->string('plh_segundo_autor')->nullable();
            $table->string('plh_tercer_autor')->nullable();
            $table->string('plh_adquisicion')->nullable();
            $table->string('plh_adecuado_para')->nullable();
            $table->string('plh_cdu')->nullable();
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
        Schema::dropIfExists('ml_abm_docs');
    }
}
