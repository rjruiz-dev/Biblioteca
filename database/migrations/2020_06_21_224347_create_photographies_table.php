<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photographies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();           
            $table->integer('generate_formats_id')->unsigned();
            $table->integer('second_author_id')->unsigned();
            $table->integer('third_author_id')->unsigned();

            $table->string('subtitle')->nullable();
            $table->string('producer')->nullable();
            $table->string('edition')->nullable();
            $table->timestamps();


            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('generate_formats_id')->references('id')->on('generate_formats')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('second_author_id')->references('id')->on('creators')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('third_author_id')->references('id')->on('creators')
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
        Schema::dropIfExists('photographies');
    }
}
