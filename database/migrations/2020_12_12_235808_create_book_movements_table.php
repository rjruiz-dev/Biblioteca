<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_movements', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('movement_types_id')->unsigned();
            $table->integer('users_id')->unsigned();            
            $table->integer('copies_id')->unsigned();
            $table->integer('courses_id')->unsigned();   

            $table->string('grupo')->nullable();
            $table->string('turno')->nullable();
            $table->integer('active');
            $table->timestamp('date');
            $table->timestamp('date_until')->nullable()->default(null);   
            $table->timestamps();

            $table->foreign('movement_types_id')->references('id')->on('movement_types')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->foreign('users_id')->references('id')->on('users')
            ->onDelete('cascade')            
            ->onUpdate('cascade'); 

            $table->foreign('copies_id')->references('id')->on('copies')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 

            $table->foreign('courses_id')->references('id')->on('courses')
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
        Schema::dropIfExists('book_movements');
    }
}
