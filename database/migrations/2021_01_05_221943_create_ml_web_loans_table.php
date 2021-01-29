<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlWebLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_web_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_wl')->nullable();
            $table->string('subtitulo_wl')->nullable();

            $table->string('dt_id_wl')->nullable();
            $table->string('dt_titulo_wl')->nullable();     
            $table->string('dt_documento_wl')->nullable();     
            $table->string('dt_tipo_wl')->nullable();            
            $table->string('dt_subtipo_wl')->nullable();      
            $table->string('dt_curso_wl')->nullable();          
            $table->string('dt_agregado_wl')->nullable();     
            $table->string('dt_acciones_wl')->nullable();

            $table->string('mod_titulo')->nullable();
            $table->string('mod_tipo_doc')->nullable();
            $table->string('mod_subtipo_doc')->nullable();
            $table->string('mod_socio')->nullable();  
            $table->string('mod_fecha')->nullable(); 
            
            $table->string('btn_aceptar')->nullable();
            $table->string('btn_rechazar')->nullable();
            $table->string('btn_cerrar')->nullable();
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
        Schema::dropIfExists('ml_web_loans');
    }
}
