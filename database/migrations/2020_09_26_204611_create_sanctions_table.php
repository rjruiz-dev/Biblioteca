<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanctions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('fines_id')->nullable()->unsigned();
            $table->timestamp('from');
            $table->timestamp('until')->nullable()->default(null); 
            $table->string('status')->nullable();
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
        Schema::dropIfExists('sanctions');
    }
}
