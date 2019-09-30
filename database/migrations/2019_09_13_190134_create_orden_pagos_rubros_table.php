<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos_rubros', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cdps_registro_valor_id')->unsigned();
            $table->foreign('cdps_registro_valor_id')->references('id')->on('cdps_registro_valor');

            $table->integer('orden_pagos_id')->unsigned();
            $table->foreign('orden_pagos_id')->references('id')->on('orden_pagos');

            $table->integer('valor');
            $table->integer('saldo');

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
        Schema::dropIfExists('orden_pagos_rubros');
    }
}
