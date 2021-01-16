<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlClassroomLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_classroom_loans', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_lc')->nullable();
            $table->string('subtitulo_lc')->nullable();
            $table->string('curso_lc')->nullable();          
            $table->string('letra_lc')->nullable();          
            $table->string('turno_lc')->nullable();
            $table->string('btn_crear_lc')->nullable();           
            $table->string('dt_registro_lc')->nullable();
            $table->string('dt_titulo_lc')->nullable();     
            $table->string('dt_autor_lc')->nullable();            
            $table->string('dt_tipodoc_lc')->nullable();      
            $table->string('dt_subtipodoc_lc')->nullable();          
            $table->string('dt_nrosocio_lc')->nullable();
            $table->string('dt_socio_lc')->nullable();  
            $table->string('dt_curso_lc')->nullable();             
            $table->string('dt_fechaprestamo_lc')->nullable();         
            $table->string('dt_fechadevolucion_lc')->nullable();            

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
        Schema::dropIfExists('ml_classroom_loans');
    }
}
