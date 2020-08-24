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

            $table->integer('generate_subjects_id')->unsigned();
            // $table->integer('generate_references_id')->unsigned();
            $table->integer('adequacies_id')->nullable()->unsigned();
            $table->integer('lenguages_id')->nullable()->unsigned();
            $table->integer('document_types_id')->unsigned();
            $table->integer('document_subtypes_id')->unsigned();
            $table->integer('creators_id')->nullable()->unsigned();
            $table->integer('status_documents_id')->unsigned();

            $table->string('title')->nullable(); 
            $table->string('original_title')->nullable();
            $table->timestamp('acquired')->nullable();        
            $table->string('let_author')->nullable();          
            $table->string('let_title')->nullable();           
            $table->string('assessment')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('published')->nullable();
            $table->string('made_by')->nullable();
            $table->timestamp('year')->nullable();
            $table->string('volume')->nullable();
            $table->string('quantity_generic')->nullable();
            $table->string('collection')->nullable();
            $table->string('location')->nullable();
            $table->mediumText('observation')->nullable();
            $table->string('note')->nullable();
            $table->mediumText('synopsis')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('generate_subjects_id')->references('id')->on('generate_subjects')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // $table->foreign('generate_references_id')->references('id')->on('generate_references')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');

            $table->foreign('adequacies_id')->references('id')->on('adequacies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('lenguages_id')->references('id')->on('lenguages')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('document_types_id')->references('id')->on('document_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('document_subtypes_id')->references('id')->on('document_subtypes')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('creators_id')->references('id')->on('creators')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('status_documents_id')->references('id')->on('status_documents')
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
        Schema::dropIfExists('documents');
    }
}
