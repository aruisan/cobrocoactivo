<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//impulsos a los predios
class CreateCategoriaImpulsoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('categoria_impulsos', function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->integer('status');

            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('categoria_impulsos');
    }
}
