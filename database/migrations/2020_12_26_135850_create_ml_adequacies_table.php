<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAdequaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_adequacies', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_adequacy')->nullable();
            $table->string('subtitulo_adequacy')->nullable();
            $table->string('btn_crear_adequacy')->nullable();
            $table->string('dt_id_adequacy')->nullable();
            $table->string('dt_adequacy')->nullable();          
            $table->string('dt_agregado_adequacy')->nullable();         
            $table->string('dt_acciones_adequacy')->nullable();
            $table->string('mod_subtitulo_adequacy')->nullable();           
            $table->string('cam_adequacy')->nullable(); 

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
        Schema::dropIfExists('ml_adequacies');
    }
}
