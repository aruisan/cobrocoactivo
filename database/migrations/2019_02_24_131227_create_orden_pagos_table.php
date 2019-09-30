<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos', function (Blueprint $table) {

            $table->increments('id');

            $table->text('nombre');
            $table->integer('valor');
            $table->integer('saldo');
            $table->integer('iva');
            $table->enum('estado', [0, 1, 2]);

            $table->integer('registros_id')->unsigned();
            $table->foreign('registros_id')->references('id')->on('registros');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('orden_pagos');
    }
}
