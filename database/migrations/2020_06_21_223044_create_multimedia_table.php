<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultimediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multimedia', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();
            $table->integer('multimedia_types_id')->unsigned();

            $table->string('author')->nullable();
            $table->string('subtitle')->nullable();            
            $table->string('second_author')->nullable();
            $table->string('third_author')->nullable();
            $table->string('isbn')->unique();
            $table->string('gender')->nullable();
            $table->string('edition')->nullable();
            $table->string('size')->nullable();        
            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('multimedia_types_id')->references('id')->on('multimedia_types')
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
        Schema::dropIfExists('multimedia');
    }
}
