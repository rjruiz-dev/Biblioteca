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

            $table->string('name');
            $table->string('surname');  
            $table->string('nickname')->unique();              
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');                    
            $table->string('gender')->nullable();         
            $table->string('address')->nullable();
            $table->integer('postcode')->nullable();           
            $table->string('phone')->nullable();
            $table->string('user_photo')->nullable();
            $table->rememberToken();
            $table->timestamp('birthdate')->nullable()->default(null);
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
