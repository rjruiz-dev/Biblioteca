<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();            
            $table->integer('generate_musics_id')->unsigned();
            $table->integer('generate_formats_id')->nullable()->unsigned();

            $table->string('sound')->nullable();         
            $table->string('producer')->nullable();
            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');
          
            $table->foreign('generate_musics_id')->references('id')->on('generate_musics')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('generate_formats_id')->references('id')->on('generate_formats')
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
        Schema::dropIfExists('music');
    }
}
