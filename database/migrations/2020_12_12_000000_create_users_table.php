<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('status_id')->unsigned();          

            $table->string('membership')->unique();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();  
            $table->string('nickname')->unique();              
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');                    
            $table->string('gender')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();         
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();           
            $table->string('phone')->nullable();
            $table->string('user_photo')->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->rememberToken();       
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status')
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
        Schema::dropIfExists('users');
    }
}
