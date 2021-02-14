<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlFrontEndsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_front_ends', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('doc_mas_recientes')->nullable();
            $table->string('recientes_cinco')->nullable();
            $table->string('recientes_diez')->nullable();
            $table->string('recientes_veinte')->nullable();
            $table->string('recientes_cincuenta')->nullable();

            $table->string('doc_mas_reservados')->nullable();
            $table->string('reservados_cinco')->nullable();
            $table->string('reservados_diez')->nullable();
            $table->string('reservados_veinte')->nullable();
            $table->string('reservados_cincuenta')->nullable();

            $table->string('mas_info')->nullable();

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
        Schema::dropIfExists('ml_front_ends');
    }
}
