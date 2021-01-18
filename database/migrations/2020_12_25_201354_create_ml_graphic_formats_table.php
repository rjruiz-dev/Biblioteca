<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlGraphicFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_graphic_formats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
          
            $table->string('titulo_fg')->nullable();
            $table->string('subtitulo_fg')->nullable();
            $table->string('btn_crear_fg')->nullable();
            $table->string('dt_id_fg')->nullable();
            $table->string('dt_fg')->nullable();          
            $table->string('dt_agregado_fg')->nullable();         
            $table->string('dt_acciones_fg')->nullable();
            $table->string('mod_subtitulo_fg')->nullable();           
            $table->string('cam_fg')->nullable();       

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
        Schema::dropIfExists('ml_graphic_formats');
    }
}
