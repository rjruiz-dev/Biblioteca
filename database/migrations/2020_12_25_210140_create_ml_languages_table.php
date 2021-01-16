<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_languages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
          
            $table->string('titulo_lang')->nullable();
            $table->string('subtitulo_lang')->nullable();
            $table->string('btn_crear_lang')->nullable();
            $table->string('dt_id_lang')->nullable();
            $table->string('dt_lang')->nullable();          
            $table->string('dt_agregado_lang')->nullable();         
            $table->string('dt_acciones_lang')->nullable();
            $table->string('mod_titulo_lang')->nullable();
            $table->string('mod_subtitulo_lang')->nullable();           
            $table->string('cam_lang')->nullable(); 

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
        Schema::dropIfExists('ml_languages');
    }
}
