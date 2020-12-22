<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_references', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
            
            $table->string('titulo_ref')->nullable();
            $table->string('subtitulo_ref')->nullable();
            $table->string('btn_crear_ref')->nullable();
            $table->string('dt_id_ref')->nullable();
            $table->string('dt_referencia')->nullable();           
            $table->string('dt_agregado_ref')->nullable();
            $table->string('dt_acciones_ref')->nullable();
            $table->string('mod_titulo_ref')->nullable();
            $table->string('mod_subtitulo_ref')->nullable();           
            $table->string('cam_formato')->nullable();
          
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
        Schema::dropIfExists('ml_references');
    }
}
