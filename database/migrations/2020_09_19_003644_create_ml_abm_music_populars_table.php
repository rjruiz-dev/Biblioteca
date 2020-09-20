<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAbmMusicPopularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_abm_music_populars', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo')->nullable();
            $table->string('subtítulo')->nullable();
            $table->string('artista')->nullable();
            $table->string('otros_artistas')->nullable();
            $table->string('musica')->nullable();
            $table->string('título_original')->nullable();
           
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
        Schema::dropIfExists('ml_abm_music_populars');
    }
}
