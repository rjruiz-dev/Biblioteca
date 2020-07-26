<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentGenerateReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_generate_reference', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id')->unsigned(); 
            $table->integer('generate_reference_id')->unsigned();           
            
            $table->foreign('document_id')->references('id')->on('documents')
            ->onDelete('cascade')
            ->onUpdate('cascade');
           
            $table->foreign('generate_reference_id')->references('id')->on('generate_references')
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
        Schema::dropIfExists('document_generate_reference');
    }
}
