<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_letters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_letter')->nullable();
            $table->string('subtitulo_letter')->nullable();
            $table->string('btn_crear_letter')->nullable();
            $table->string('dt_id_letter')->nullable();
            $table->string('dt_titulo_letter')->nullable();          
            $table->string('dt_cuerpo_letter')->nullable();
            $table->string('dt_despedida_letter')->nullable();          
            $table->string('dt_agregado_letter')->nullable();         
            $table->string('dt_acciones_letter')->nullable();
            $table->string('mod_subtitulo_letter')->nullable();           
            $table->string('cam_titulo_letter')->nullable(); 
            $table->string('cam_cuerpo_letter')->nullable(); 
            $table->string('cam_despedida_letter')->nullable(); 

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
        Schema::dropIfExists('ml_letters');
    }
}
