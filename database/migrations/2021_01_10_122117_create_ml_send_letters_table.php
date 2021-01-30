<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlSendLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_send_letters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();           
            $table->string('select_modelo')->nullable();
            $table->string('ph_modelo')->nullable(); 
            $table->string('fecha')->nullable();
            $table->string('select_enviar')->nullable();           
            $table->string('ph_enviar')->nullable();
            $table->string('check_informe')->nullable();                     
            $table->string('btn_email')->nullable(); 
            $table->string('mensaje_exito')->nullable();
            $table->string('noti_envio_mails')->nullable();  
                      
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
        Schema::dropIfExists('ml_send_letters');
    }
}
