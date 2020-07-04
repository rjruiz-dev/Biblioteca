<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populars', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('music_id')->unsigned();
            
            $table->string('album_title')->unique();
            $table->string('subtitle')->nullable(); //
            $table->string('artist');//
            $table->string('other_artists')->nullable();//
            $table->string('music_populars')->nullable();//

            $table->timestamps();

            $table->foreign('music_id')->references('id')->on('music')
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
        Schema::dropIfExists('populars');
    }
}
