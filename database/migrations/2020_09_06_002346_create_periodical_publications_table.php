<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodicalPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodical_publications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('books_id')->unsigned();
            $table->integer('periodicities_id')->nullable()->unsigned();

            $table->string('volume_number_date')->nullable();
            $table->string('issn')->nullable()->unique();
            $table->timestamps();

            $table->foreign('books_id')->references('id')->on('books')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('periodicities_id')->references('id')->on('periodicities')
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
        Schema::dropIfExists('periodical_publications');
    }
}
