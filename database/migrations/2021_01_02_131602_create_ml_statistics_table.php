<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_statistics', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('estadistica')->nullable();
            $table->string('mes_y_año')->nullable();
            $table->string('ph_mes_y_año')->nullable();
            $table->string('btn_buscar')->nullable();

            $table->string('total')->nullable();

            $table->string('sub_socio')->nullable();            
            $table->string('sub_prestamo')->nullable();
            $table->string('sub_coleccion')->nullable();                      
            $table->string('col_tipodesocio')->nullable();
            $table->string('col_alta')->nullable();
            $table->string('col_baja')->nullable();            
            $table->string('col_prestamo')->nullable();      
            $table->string('col_libro')->nullable();          
            $table->string('col_cine')->nullable();
            $table->string('col_musica')->nullable();
            $table->string('col_multimedia')->nullable();
            $table->string('col_fotografia')->nullable();          
            $table->string('col_librodigital')->nullable();         
            $table->string('col_coleccion')->nullable(); 
            $table->string('infantil')->nullable();
            $table->string('adulto')->nullable();          
            $table->string('incorporacion')->nullable();         
            $table->string('baja')->nullable();            

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
        Schema::dropIfExists('ml_statistics');
    }
}
