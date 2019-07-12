<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosPucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos_pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('rubros_puc_id')->unsigned();
            $table->foreign('rubros_puc_id')->references('id')->on('rubros_pucs');

            $table->integer('orden_pago_id')->unsigned();
            $table->foreign('orden_pago_id')->references('id')->on('orden_pagos');

            $table->integer('valor_debito');
            $table->integer('valor_credito');

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
        Schema::dropIfExists('orden_pagos_pucs');
    }
}
