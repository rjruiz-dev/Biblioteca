<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentSubtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_types_id')->unsigned();
            $table->string('subtype_name'); 
            $table->timestamps();

            $table->foreign('document_types_id')->references('id')->on('document_types')
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
        Schema::dropIfExists('document_subtypes');
    }
}
