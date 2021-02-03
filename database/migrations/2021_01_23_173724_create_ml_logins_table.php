<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_logins', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('pri_nombre_is')->nullable();
            $table->string('seg_nombre_is')->nullable();
            $table->string('login_is')->nullable();
            $table->string('login_msg_is')->nullable();
            $table->string('email_is')->nullable();
            $table->string('contraseña_is')->nullable(); 
            $table->string('link_pass_is')->nullable();
            $table->string('btn_entrar_is')->nullable();           
            
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
        Schema::dropIfExists('ml_logins');
    }
}
