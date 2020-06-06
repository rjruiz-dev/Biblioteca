<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();
            $table->integer('book_types')->unsigned();
            $table->integer('genders_id')->unsigned();

            $table->string('author')->nullable();
            $table->string('subtitle')->nullable(); 
            $table->string('second_author')->nullable();
            $table->string('third_author')->nullable();
            $table->string('translator')->nullable();
            $table->string('edition')->nullable();
            $table->string('size')->nullable();


            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('book_types_id')->references('id')->on('book_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('genders_id')->references('id')->on('genders')
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
        Schema::dropIfExists('books');
    }
}
