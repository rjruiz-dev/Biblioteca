<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlWebRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_web_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
            
            $table->string('titulo_wr')->nullable();
            $table->string('subtitulo_wr')->nullable();
            
            $table->string('dt_id_wr')->nullable();
            $table->string('dt_nombre_wr')->nullable();           
            $table->string('dt_usuario_wr')->nullable();
            $table->string('dt_email_wr')->nullable();
            $table->string('dt_estado_wr')->nullable();
            $table->string('dt_agregado_wr')->nullable();
            $table->string('dt_acciones_wr')->nullable();         
          
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
        Schema::dropIfExists('ml_web_requests');
    }
}
