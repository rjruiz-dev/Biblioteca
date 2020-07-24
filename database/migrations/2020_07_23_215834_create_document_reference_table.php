<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_reference', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('document_id')->unsigned(); 
            $table->integer('reference_id')->unsigned();           
            
            $table->foreign('document_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');
           
            $table->foreign('reference_id')->references('id')->on('references')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_reference');
    }
}
