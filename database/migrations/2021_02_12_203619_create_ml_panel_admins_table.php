<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlPanelAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_panel_admins', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('doc_mas_recientes')->nullable();
            $table->string('panel_de_control')->nullable();
            $table->string('documentos')->nullable();
            $table->string('documentos_registrados')->nullable();
            $table->string('prestamos')->nullable();
            $table->string('Prestamos registrados')->nullable();
            $table->string('prestamos_vencidos')->nullable();
            $table->string('vencidos_registrados')->nullable();
            $table->string('usuarios')->nullable();
            $table->string('usuarios_registrados')->nullable();
            $table->string('ultimos_cinco_prestamos')->nullable();
            $table->string('pres_id')->nullable();
            $table->string('pres_prefil')->nullable();
            $table->string('pres_nombre')->nullable();
            $table->string('pres_email')->nullable();
            $table->string('pres_titulo')->nullable();
            $table->string('pres_fecha_devolucion')->nullable();
            $table->string('pres_n_ejemplar')->nullable();
            $table->string('pres_cant_prestamos')->nullable();
            $table->string('prestamos_vencidos_tit')->nullable();
            $table->string('venc_id')->nullable();
            $table->string('venc_perfil')->nullable();
            $table->string('venc_nombre')->nullable();
            $table->string('venc_email')->nullable();
            $table->string('venc_titulo')->nullable();
            $table->string('venc_fecha_devolucion')->nullable();
            $table->string('venc_n_ejemplar')->nullable();
            $table->string('venc_cant_prestamos')->nullable();

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
        Schema::dropIfExists('ml_panel_admins');
    }
}
