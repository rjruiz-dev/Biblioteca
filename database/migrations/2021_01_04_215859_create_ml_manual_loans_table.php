<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlManualLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_manual_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_ml')->nullable();
            $table->string('subtitulo_ml')->nullable();

            $table->string('dt_id_ml')->nullable();
            $table->string('dt_titulo_ml')->nullable();     
            $table->string('dt_tipo_ml')->nullable();            
            $table->string('dt_subtipo_ml')->nullable();      
            $table->string('dt_copias_ml')->nullable();          
            $table->string('dt_acciones_ml')->nullable();

            $table->string('titulo_index')->nullable(); 

            $table->string('seccion_doc')->nullable();
            $table->string('tipo_doc')->nullable();
            $table->string('tipo_libro')->nullable();

            $table->string('seccion_prestamo')->nullable();
            $table->string('select_registro')->nullable();
            $table->string('ph_registro')->nullable();                      
            $table->string('select_usuario')->nullable();
            $table->string('ph_usuario')->nullable();  
            $table->string('nickname')->nullable();
            $table->string('apellido')->nullable();            
            $table->string('email')->nullable();      
            $table->string('cant_prestamos')->nullable();          
            $table->string('select_curso')->nullable();
            $table->string('ph_curso')->nullable();
            $table->string('select_grupo')->nullable();
            $table->string('ph_grupo')->nullable(); 
            $table->string('select_turno')->nullable();
            $table->string('ph_turno')->nullable();              
            $table->string('fecha_prestamo')->nullable();
            $table->string('btn_prestar')->nullable();
            
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
        Schema::dropIfExists('ml_manual_loans');
    }
}
