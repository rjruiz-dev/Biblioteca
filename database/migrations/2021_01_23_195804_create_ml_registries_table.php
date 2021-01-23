<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_registries', function (Blueprint $table) {
            $table->increments('id');
          
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_reg')->nullable();
            $table->string('info_reg')->nullable();
            $table->string('seccion')->nullable();
            $table->string('nombre_reg')->nullable();
            $table->string('apellido_reg')->nullable();
            $table->string('nickname_reg')->nullable(); 
            $table->string('email_reg')->nullable();
            $table->string('fecha_nac_reg')->nullable();
            $table->string('ph_fecha_nac_reg')->nullable();
            $table->string('btn_cerrar_reg')->nullable();
            $table->string('btn_enviar_reg')->nullable();           
            
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
        Schema::dropIfExists('ml_registries');
    }
}
