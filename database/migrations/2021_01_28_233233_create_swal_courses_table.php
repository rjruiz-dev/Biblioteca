<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwalCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swal_courses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('swal_exito')->nullable();
            $table->string('swal_info_exito')->nullable();
            $table->string('swal_baja')->nullable();           
            $table->string('swal_info_baja')->nullable();
            $table->string('swal_reactivar')->nullable();           
            $table->string('swal_info_reactivar')->nullable();
            $table->string('swal_warning_baja_')->nullable();           
            $table->string('swal_bajado')->nullable();
            $table->string('swal_warning_reactivar')->nullable();           
            $table->string('swal_reactivado')->nullable();
            $table->string('swal_info_savebtn_borrar_c')->nullable();           
            
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
        Schema::dropIfExists('swal_courses');
    }
}
