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

            $table->integer('adequacies_id')->unsigned();
            $table->integer('lenguages_id')->unsigned();
            $table->integer('document_types_id')->unsigned();
            $table->integer('document_subtypes_id')->unsigned();
            $table->integer('creators_id')->unsigned();

            $table->string('title')->nullable();
            $table->integer('registry_number')->nullable();
            $table->string('original_title')->nullable();
            $table->timestamp('acquired')->nullable();
            $table->timestamp('drop')->nullable();
            $table->string('document_status')->nullable();
            $table->string('let_author')->nullable();
            $table->string('cdu')->unique();
            $table->string('let_title')->nullable();
            $table->string('assessment')->nullable();
            $table->string('desidherata')->nullable();
            $table->string('published')->nullable();
            $table->string('made_by')->nullable();
            $table->timestamp('year')->nullable();
            $table->string('volumes')->nullable();
            $table->string('page')->nullable();
            $table->string('collection')->nullable();
            $table->string('location');
            $table->mediumText('observation')->nullable();
            $table->string('note')->nullable();
            $table->mediumText('synopsis')->nullable();
            $table->string('photo')->nullable();
            $table->integer('quantity_generic')->nullable();
            $table->timestamps();

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
