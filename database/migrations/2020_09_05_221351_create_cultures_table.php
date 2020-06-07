<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCulturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultures', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('music_id')->unsigned();
            
            $table->string('album_title')->unique();
            $table->string('soloist')->nullable();
            $table->string('orchestra')->nullable();
            $table->string('director')->nullable();
            $table->string('composer')->nullable();


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
        Schema::dropIfExists('cultures');
    }
}
