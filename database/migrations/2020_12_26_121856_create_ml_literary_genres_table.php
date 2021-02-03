<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLiteraryGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_literary_genres', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_gl')->nullable();
            $table->string('subtitulo_gl')->nullable();
            $table->string('btn_crear_gl')->nullable();
            $table->string('dt_id_gl')->nullable();
            $table->string('dt_gl')->nullable();          
            $table->string('dt_agregado_gl')->nullable();         
            $table->string('dt_acciones_gl')->nullable();
            $table->string('mod_subtitulo_gl')->nullable();           
            $table->string('cam_gl')->nullable(); 

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
        Schema::dropIfExists('ml_literary_genres');
    }
}
