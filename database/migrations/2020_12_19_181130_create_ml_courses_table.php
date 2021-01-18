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
          
            $table->string('titulo_curso')->nullable();
            $table->string('subtitulo_curso')->nullable();
            $table->string('btn_crear_curso')->nullable();
            $table->string('dt_id_curso')->nullable();
            $table->string('dt_curso')->nullable();
            $table->string('dt_grupo')->nullable();
            $table->string('dt_agregado_curso')->nullable();
            $table->string('dt_estado')->nullable();
            $table->string('dt_acciones_curso')->nullable();
            $table->string('mod_subtitulo_curso')->nullable();           
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
