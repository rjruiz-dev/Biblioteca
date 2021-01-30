<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_partners', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            // datatable
            $table->string('titulo_ams')->nullable();
            $table->string('subtitulo_ams')->nullable();
           
            $table->string('dt_id_ams')->nullable();
            $table->string('dt_usuario_ams')->nullable(); 
            $table->string('dt_nickname_ams')->nullable();
            $table->string('dt_perfil_ams')->nullable();           
            $table->string('dt_nombre_ams')->nullable();
            $table->string('dt_email_ams')->nullable();
            $table->string('dt_estado_ams')->nullable();           
            $table->string('dt_agregado_ams')->nullable();
            $table->string('dt_acciones_ams')->nullable();

            // form
            $table->string('mod_titulo')->nullable();

            $table->string('seccion_perfil')->nullable();  
            $table->string('mod_select_tipo')->nullable();
            $table->string('mod_check_biblio')->nullable();  
            $table->string('mod_check_socio')->nullable();
            $table->string('mod_num_user')->nullable();  
            $table->string('mod_span_num')->nullable();
            $table->string('mod_nickname')->nullable(); 
            $table->string('mod_select_estado')->nullable();  
            $table->string('mod_ph_estado')->nullable();
            $table->string('mod_imagen')->nullable();  
            $table->string('mod_email')->nullable();
            $table->string('mod_span_email')->nullable();             
          
            $table->string('seccion_personales')->nullable();  
            $table->string('mod_nombre')->nullable();
            $table->string('mod_apellido')->nullable();  
            $table->string('mod_select_genero')->nullable();
            $table->string('mod_ph_genero')->nullable();  
            $table->string('mod_fecha_nac')->nullable();  
            $table->string('mod_pass')->nullable();  
            $table->string('mod_span_pass')->nullable();  
            $table->string('mod_repite_pass')->nullable();            

            $table->string('seccion_direccion')->nullable();  
            $table->string('mod_telefono')->nullable();
            $table->string('mod_direccion')->nullable();  
            $table->string('mod_cod_postal')->nullable();
            $table->string('mod_ciudad')->nullable();  
            $table->string('mod_select_provincia')->nullable();
            $table->string('mod_ph_provincia')->nullable();            
                  
            // show
            $table->string('mod_titulo_show')->nullable();
            $table->string('mod_usuario')->nullable();              
            $table->string('mod_estado')->nullable();            
            $table->string('mod_info_direccion')->nullable();  
            $table->string('mod_info_cod_postal')->nullable();
            $table->string('mod_info_telefono')->nullable();
            
            // botones
            $table->string('btn_crear')->nullable();     
            $table->string('btn_actualizar')->nullable();       
            $table->string('btn_cerrar')->nullable(); 

            $table->string('mensaje_exito')->nullable(); 
            $table->string('noti_alta_socio')->nullable(); 
            $table->string('noti_edicion_socio')->nullable(); 
            $table->string('preg_reactivar_socio')->nullable(); 
            $table->string('resp_reactivar_socio')->nullable(); 
            $table->string('preg_baja_socio')->nullable(); 
            $table->string('resp_baja_socio')->nullable();
            
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
        Schema::dropIfExists('ml_partners');
    }
}
