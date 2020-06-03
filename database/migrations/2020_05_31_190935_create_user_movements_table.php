<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_movements', function (Blueprint $table) {
            $table->increments('id');
           
            $table->integer('actions_id')->unsigned();
            $table->integer('users_id')->unsigned();    

            $table->timestamps('date');

            $table->foreign('actions_id')->references('id')->on('actions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('users_id')->references('id')->on('users')
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
        Schema::dropIfExists('user_movements');
    }
}
