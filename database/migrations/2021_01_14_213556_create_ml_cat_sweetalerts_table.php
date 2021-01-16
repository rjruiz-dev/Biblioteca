<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCatSweetalertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_cat_sweetalerts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

       $table->string('mensaje_exito')->nullable();
       $table->string('alta_documento')->nullable();
       $table->string('actualizacion_documento')->nullable();

       $table->string('preg_solicitar_documento')->nullable();
       $table->string('resp_solicitar_documento')->nullable();

       $table->string('preg_baja_documento')->nullable();
       $table->string('resp_baja_documento')->nullable();

       $table->string('preg_rechazar_documento')->nullable();
       $table->string('resp_rechazar_documento')->nullable();

       $table->string('preg_reactivar_documento')->nullable();
       $table->string('resp_reactivar_documento')->nullable();

       $table->string('preg_aceptar_documento')->nullable();
       $table->string('resp_aceptar_documento')->nullable();

       $table->string('preg_desidherata_documento')->nullable();
       $table->string('resp_desidherata_documento')->nullable();

       $table->string('actualizacion_copia')->nullable();
       $table->string('alta_copia')->nullable();
  
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
        Schema::dropIfExists('ml_cat_sweetalerts');
    }
}
