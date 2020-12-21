<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_courses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
          
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('btn_crear')->nullable();
            $table->string('dt_id')->nullable();
            $table->string('dt_curso')->nullable();
            $table->string('dt_grupo')->nullable();
            $table->string('dt_agregado')->nullable();
            $table->string('dt_estado')->nullable();
            $table->string('dt_acciones')->nullable();
            $table->string('mod_titulo')->nullable();
            $table->string('mod_subtitulo')->nullable();           
            $table->string('cam_nombre_curso')->nullable();
            $table->string('cam_grupo')->nullable();
            $table->string('cam_grupo_si')->nullable();
            $table->string('cam_grupo_no')->nullable();
           
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
        Schema::dropIfExists('ml_courses');
    }
}
