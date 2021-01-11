<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLoanDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_loan_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_ld')->nullable();
            $table->string('subtitulo_ld')->nullable();
           
            $table->string('dt_id_ld')->nullable();
            $table->string('dt_titulo_ld')->nullable(); 
            $table->string('dt_tipo_ld')->nullable();
            $table->string('dt_subtipo_ld')->nullable();           
            $table->string('dt_copias_ld')->nullable();
            $table->string('dt_acciones_ld')->nullable();
                     
            $table->string('titulo_index_ld')->nullable(); 

            $table->string('seccion_doc')->nullable();
            $table->string('tipo_doc')->nullable();
            $table->string('tipo_libro')->nullable();           
            
            $table->string('num_copia_ld')->nullable();
            $table->string('estado')->nullable();
            $table->string('prestado_a')->nullable();     
            $table->string('prestado_ld')->nullable();                      
            $table->string('devolver_ld')->nullable();
            $table->string('dias_retraso_ld')->nullable();  
            $table->string('sancion_ld')->nullable();
            $table->string('economica_ld')->nullable();            
            $table->string('btn_devolver_ld')->nullable();      
            $table->string('btn_renovar_ld')->nullable();
            $table->string('btn_prestamo_ld')->nullable();     
            $table->string('btn_cerrar_ld')->nullable();      
            $table->string('btn_si_ld')->nullable();          
  
            $table->string('mod_titulo_ld')->nullable();
            $table->string('mod_subtitulo_ld')->nullable();           
            $table->string('cam_devolver_ld')->nullable();           

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
        Schema::dropIfExists('ml_loan_documents');
    }
}
