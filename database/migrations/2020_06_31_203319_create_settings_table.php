<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('fines_id')->nullable()->unsigned();  

            $table->string('library_name')->nullable()->unique();
            $table->string('library_email')->nullable()->unique();
            $table->string('library_phone')->nullable();
            $table->string('language')->nullable();
            $table->string('logo')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('child_age')->nullable();
            $table->string('adult_age')->nullable();
            $table->string('skin')->nullable();
            $table->string('skin_footer')->nullable();
           
            $table->integer('loan_day')->nullable();
            $table->integer('loan_limit')->nullable();
            $table->timestamps();

            $table->foreign('fines_id')->references('id')->on('fines')
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
        Schema::dropIfExists('settings');
    }
}
