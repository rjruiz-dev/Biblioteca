<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_passwords', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('many_lenguages_id')->nullable()->unsigned();

            $table->string('pri_nombre_rp')->nullable();
            $table->string('seg_nombre_rp')->nullable();
            $table->string('reset_rp')->nullable();
            $table->string('reset_msg_rp')->nullable();
            $table->string('email_rp')->nullable();
            $table->string('btn_reestablecer_rp')->nullable();           
            
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
        Schema::dropIfExists('ml_passwords');
    }
}
