<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLoanPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_loan_partners', function (Blueprint $table) {
            $table->increments('id'); 
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_lp')->nullable();
            $table->string('subtitulo_lp')->nullable();
           
            $table->string('dt_id_lp')->nullable();
            $table->string('dt_socio_lp')->nullable(); 
            $table->string('dt_nickname_lp')->nullable();
            $table->string('dt_nombre_lp')->nullable();           
            $table->string('dt_email_lp')->nullable();
            $table->string('dt_estado_lp')->nullable();                 
            $table->string('dt_acciones_lp')->nullable();
                     
            $table->string('titulo_index_lp')->nullable(); 

            $table->string('seccion_socio')->nullable();
            $table->string('genero')->nullable();
            $table->string('fecha_nac')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cod_postal')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('provincia')->nullable();

            $table->string('seccion_prestamo')->nullable();
            $table->string('num_copia')->nullable();
            $table->string('prestado_el')->nullable();                      
            $table->string('devolver_el')->nullable();
            $table->string('dias_retraso')->nullable();  
            $table->string('sancion')->nullable();
            $table->string('economica')->nullable();            
            $table->string('btn_devolver')->nullable();      
            $table->string('btn_renovar')->nullable();
            $table->string('btn_cerrar')->nullable();      
            $table->string('btn_si')->nullable();          
  
            $table->string('mod_titulo_lp')->nullable();
            $table->string('mod_subtitulo_lp')->nullable();           
            $table->string('cam_devolver_lp')->nullable();           

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
        Schema::dropIfExists('ml_loan_partners');
    }
}
