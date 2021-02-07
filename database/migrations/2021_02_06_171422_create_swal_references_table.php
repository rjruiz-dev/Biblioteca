<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwalReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swal_references', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('swal_reference')->nullable();
            $table->string('swal_exito')->nullable();
            $table->string('swal_info_exito')->nullable();
            
            $table->string('swal_eliminar')->nullable();
            $table->string('swal_info_eliminar')->nullable();

            $table->string('swal_advertencia')->nullable();     
            $table->string('swal_info_advertencia')->nullable();            
           
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
        Schema::dropIfExists('swal_references');
    }
}
