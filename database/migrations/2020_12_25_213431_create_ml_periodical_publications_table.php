<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlPeriodicalPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_periodical_publications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_publ')->nullable();
            $table->string('subtitulo_publ')->nullable();
            $table->string('btn_crear_publ')->nullable();
            $table->string('dt_id_publ')->nullable();
            $table->string('dt_publ')->nullable();          
            $table->string('dt_agregado_publ')->nullable();         
            $table->string('dt_acciones_publ')->nullable();
            $table->string('mod_titulo_publ')->nullable();
            $table->string('mod_subtitulo_publ')->nullable();           
            $table->string('cam_publ')->nullable(); 

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
        Schema::dropIfExists('ml_periodical_publications');
    }
}
