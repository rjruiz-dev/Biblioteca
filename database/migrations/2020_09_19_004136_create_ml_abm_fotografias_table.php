<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAbmFotografiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_abm_fotografias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('crear_fotografia')->nullable();
            $table->string('tipo_de_fotografia')->nullable();
            $table->string('realizador')->nullable();
            $table->string('edicion')->nullable();
            $table->string('num_diapositivas')->nullable();
            $table->string('Observaciones')->nullable();
            $table->string('detalles_de_la_fotografia')->nullable();
            
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
        Schema::dropIfExists('ml_abm_fotografias');
    }
}
