<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('documents_id')->unsigned();            
            $table->integer('status_copy_id')->unsigned();

            $table->integer('registry_number')->nullable();  
            
            $table->timestamps();

            $table->foreign('documents_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('status_copy_id')->references('id')->on('movement_types')
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
        Schema::dropIfExists('copies');
    }
}
