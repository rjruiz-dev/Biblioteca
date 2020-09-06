<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_dashboards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();
            $table->string('biblioteca')->nullable();
            $table->string('iniciar_sesion')->nullable();
            $table->string('registrarse')->nullable();
            $table->string('navegacion')->nullable();
            $table->string('invitado')->nullable();
            $table->string('en_linea')->nullable();
            $table->string('inicio')->nullable();
            $table->string('libros')->nullable();
            $table->string('cines')->nullable();
            $table->string('musica')->nullable();
            $table->string('fotografia')->nullable();
            $table->string('multimedia')->nullable();
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
        Schema::dropIfExists('ml_dashboards');
    }
}
