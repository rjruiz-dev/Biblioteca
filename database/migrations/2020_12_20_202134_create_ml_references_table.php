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
            
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('btn_crear')->nullable();
            $table->string('dt_id')->nullable();
            $table->string('dt_referencia')->nullable();           
            $table->string('dt_agregado')->nullable();
            $table->string('dt_acciones')->nullable();
            $table->string('mod_titulo')->nullable();
            $table->string('mod_subtitulo')->nullable();           
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
