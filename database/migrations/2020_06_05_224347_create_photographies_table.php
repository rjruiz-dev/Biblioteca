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
            $table->integer('type_photographies_id')->unsigned();


            $table->string('subtitle')->nullable();
            $table->string('author')->nullable();
            $table->string('second_author')->nullable();
            $table->string('third_author')->nullable();
            $table->string('producer')->nullable();
            $table->string('edition')->nullable();
            $table->string('format')->nullable();
            


            $table->timestamps();


            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('type_photographies_id')->references('id')->on('type_photographies')
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
