<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlDatabaseRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_database_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo_dr')->nullable();     
            $table->string('dt_id_dr')->nullable();
            $table->string('dt_concepto_dr')->nullable();     
            $table->string('dt_registro_dr')->nullable();            
               

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
        Schema::dropIfExists('ml_database_records');
    }
}
