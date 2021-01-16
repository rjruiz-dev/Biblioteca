<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLibraryProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_library_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('titulo')->nullable();

            $table->string('logo')->nullable();
            
            $table->string('perfil')->nullable();
            $table->string('biblioteca')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('idioma')->nullable();
            $table->string('select_logo')->nullable();                      
            $table->string('medidas_logo')->nullable();

            $table->string('direccion')->nullable();
            $table->string('calle')->nullable();            
            $table->string('codigo_postal')->nullable();      
            $table->string('ciudad')->nullable();          
            $table->string('provincia')->nullable();
            $table->string('pais')->nullable();
            
            $table->string('config_prestamo')->nullable();          
            $table->string('cant_max_prestamo')->nullable();         
            $table->string('cant_max_dias')->nullable(); 
            $table->string('tipo_multa')->nullable();          
            $table->string('economica')->nullable();         
            $table->string('sancion')->nullable(); 
            $table->string('sancion_economica')->nullable();          
            $table->string('dias_sancion')->nullable();   
            
            
            $table->string('otros_detalles')->nullable(); 
            $table->string('edad_infantil')->nullable();
            $table->string('edad_adulto')->nullable();          
            $table->string('select_color')->nullable();         
            $table->string('info_color')->nullable();  
            $table->string('select_color_fuente')->nullable();         
            $table->string('info_color_fuente')->nullable();  
            

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
        Schema::dropIfExists('ml_library_profiles');
    }
}
