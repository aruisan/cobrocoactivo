<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos_fechas', function (Blueprint $table) {
            $table->increments('id');

            $table->date('fecha');
            $table->integer('valor');

            $table->integer('orden_pagos_id')->unsigned();
            $table->foreign('orden_pagos_id')->references('id')->on('orden_pagos');

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
        Schema::dropIfExists('orden_pagos_fechas');
    }
}
