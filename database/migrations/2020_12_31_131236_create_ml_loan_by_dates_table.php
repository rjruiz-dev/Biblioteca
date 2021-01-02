<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLoanByDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_loan_by_dates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_ld')->nullable();
            $table->string('subtitulo_ld')->nullable();
            $table->string('fecha_desde_ld')->nullable();          
            $table->string('fecha_hasta_ld')->nullable();          
            $table->string('btn_crear_ld')->nullable();
            $table->string('dt_id_ld')->nullable();
            $table->string('dt_registro_ld')->nullable();
            $table->string('dt_titulo_ld')->nullable();            
            $table->string('dt_tipodoc_ld')->nullable();      
            $table->string('dt_subtipodoc_ld')->nullable();          
            $table->string('dt_nrosocio_ld')->nullable();
            $table->string('dt_nombre_ld')->nullable();          
            $table->string('dt_fechaprestamo_ld')->nullable();         
            $table->string('dt_fechadevolucion_ld')->nullable();            

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
        Schema::dropIfExists('ml_loan_by_dates');
    }
}
