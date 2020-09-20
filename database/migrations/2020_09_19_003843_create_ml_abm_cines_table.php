<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAbmCinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_abm_cines', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('crear_cine')->nullable();
            $table->string('reparto')->nullable();
            $table->string('adaptacion')->nullable();
            $table->string('guión')->nullable();
            $table->string('cont_específico')->nullable();
            $table->string('diglas_director')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('productora')->nullable();
            $table->string('distribuidora')->nullable();
            $table->string('premios')->nullable();
           
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
        Schema::dropIfExists('ml_abm_cines');
    }
}
