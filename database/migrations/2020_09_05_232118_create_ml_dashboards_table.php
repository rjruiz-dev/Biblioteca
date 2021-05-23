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
            
            $table->string('gestion')->nullable();
            $table->string('prestamos_web')->nullable();
            $table->string('prestamos_manuales')->nullable();
            $table->string('prest_y_dev')->nullable();
            $table->string('pyd_por_socio')->nullable();
            $table->string('pyd_por_doc')->nullable();
            $table->string('correspondencia')->nullable();
            $table->string('reclamar_prestamos')->nullable();
            $table->string('socios')->nullable();
            $table->string('socios_alta_manual')->nullable();
            $table->string('socios_solicitudes')->nullable();
            $table->string('catalogo')->nullable();
            $table->string('libros')->nullable();
            $table->string('cines')->nullable();
            $table->string('musica')->nullable();
            $table->string('fotografia')->nullable();
            $table->string('multimedia')->nullable();
            $table->string('importar_rebeca')->nullable();
            $table->string('importaciones_rebeca')->nullable();
            $table->string('mantenimiento')->nullable();
            $table->string('mant_cursos')->nullable();
            $table->string('mant_maestros')->nullable();
            $table->string('mant_formatos')->nullable();
            $table->string('mant_idiomas')->nullable();
            $table->string('mant_public_period')->nullable();
            $table->string('mant_generos_lit')->nullable();
            $table->string('mant_generos_musicales')->nullable();
            $table->string('mant_generos_cinemato')->nullable();
            $table->string('mant_personas_adecuadas')->nullable();
            $table->string('mant_materias')->nullable();
            $table->string('mant_modelos_carta')->nullable();
            $table->string('listados')->nullable();
            $table->string('prestamos_por_fecha')->nullable();
            $table->string('prestamos_por_aula')->nullable();
            $table->string('registros_db')->nullable();
            $table->string('estadisticas')->nullable();
            $table->string('gestion_multi_idioma')->nullable();
        
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
