<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlMusicalGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_musical_genres', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_gm')->nullable();
            $table->string('subtitulo_gm')->nullable();
            $table->string('btn_crear_gm')->nullable();
            $table->string('dt_id_gm')->nullable();
            $table->string('dt_gm')->nullable();          
            $table->string('dt_agregado_gm')->nullable();         
            $table->string('dt_acciones_gm')->nullable();
            $table->string('mod_titulo_gm')->nullable();
            $table->string('mod_subtitulo_gm')->nullable();           
            $table->string('cam_gm')->nullable(); 

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
        Schema::dropIfExists('ml_musical_genres');
    }
}
