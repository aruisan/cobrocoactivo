<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterRegister extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_padres', function (Blueprint $table){
            $table->increments('id');
            $table->integer('register_id')->unsigned();
            $table->foreign('register_id')->references('id')->on('registers');
            $table->integer('register2_id')->unsigned();
            $table->foreign('register2_id')->references('id')->on('registers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_padres');
    }
}
