<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos_payments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('orden_pago_id')->unsigned();
            $table->foreign('orden_pago_id')->references('id')->on('orden_pagos');

            $table->integer('puc_id')->unsigned();
            $table->foreign('puc_id')->references('id')->on('pucs');

            $table->integer('num');
            $table->integer('valor');
            $table->enum('type_pay', ['CHEQUE', 'ACCOUNT','CASH']);

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
        Schema::dropIfExists('orden_pagos_payments');
    }
}
