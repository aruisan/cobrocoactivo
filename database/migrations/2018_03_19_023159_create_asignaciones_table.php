<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//
class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cc_id');
            $table->enum('tabla',['predios','juridicos','transitos','policivos']);// campo referencia a las tablas cc 
            $table->timestamps();


            $table->integer('abogado_id')->nullable()->unsigned();
            $table->foreign('abogado_id')->references('id')->on('users');
            $table->integer('secretaria_id')->nullable()->unsigned();
            $table->foreign('secretaria_id')->references('id')->on('users');

        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('asignaciones');
    }
}
