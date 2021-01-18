<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_subjects', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_subject')->nullable();
            $table->string('subtitulo_subject')->nullable();
            $table->string('btn_crear_subject')->nullable();
            $table->string('dt_id_subject')->nullable();
            $table->string('dt_subject')->nullable();          
            $table->string('dt_cdu_subject')->nullable();          
            $table->string('dt_agregado_subject')->nullable();         
            $table->string('dt_acciones_subject')->nullable();
            $table->string('mod_subtitulo_subject')->nullable();           
            $table->string('cam_subject')->nullable(); 
            $table->string('cam_cdu_subject')->nullable(); 

            $table->timestamps();

            $table->foreign('many_lenguages_id')->references('id')->on('many_lenguages')
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
        Schema::dropIfExists('ml_subjects');
    }
}
