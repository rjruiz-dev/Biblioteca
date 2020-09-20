<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlShowMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_show_musics', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();
            
            $table->string('titulo_de_la_obra')->nullable();
            $table->string('director')->nullable();
            $table->string('sobre_la_musica')->nullable();
            $table->string('compositor')->nullable();
            $table->string('orquesta')->nullable();
            $table->string('editado_en')->nullable();
            $table->string('sello_discofrafico')->nullable();
            $table->string('detalles_de_la_musica')->nullable();
            
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
        Schema::dropIfExists('ml_show_musics');
    }
}
