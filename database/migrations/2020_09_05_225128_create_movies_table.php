<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();
            $table->integer('formats_id')->unsigned();

            $table->string('subtitle')->nullable();
            $table->string('director');
            $table->string('distribution')->nullable();
            $table->string('original_title')->unique();
            $table->string('script')->nullable();
            $table->string('specific_content')->nullable();
            $table->string('gender')->nullable();
            $table->string('photography')->nullable();
            $table->string('awards')->nullable();
            $table->string('distributor')->nullable();
            $table->string('format')->nullable();
            
            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('formats_id')->references('id')->on('formats')
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
        Schema::dropIfExists('movies');
    }
}
