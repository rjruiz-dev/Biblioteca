<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('suitable')->unsigned();
            $table->string('lenguajes')->unsigned();

            $table->string('title')->nullable();
            $table->string('original_title')->nullable();
            $table->string('acquired')->nullable();
            $table->string('document_status')->nullable();
            $table->string('let_author')->nullable();
            $table->string('cdu')->nullable();
            $table->string('let_title')->nullable();
            $table->string('assessment')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('published')->nullable();
            $table->string('made_by')->nullable();
            $table->integer('year')->nullable();
            $table->string('volume')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('collection')->nullable();
            $table->string('location')->nullable();
            $table->string('observation')->nullable();
            $table->string('note')->nullable();
            


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
        Schema::dropIfExists('documents');
    }
}
