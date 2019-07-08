<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenPagosDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pagos_descuentos', function (Blueprint $table) {
            $table->increments('id');

            $table->text('nombre');
            $table->integer('porcent');
            $table->integer('base');
            $table->integer('valor');

            $table->integer('orden_pagos_id')->unsigned();
            $table->foreign('orden_pagos_id')->references('id')->on('orden_pagos');

            $table->integer('retencion_fuente_id')->unsigned();
            $table->foreign('retencion_fuente_id')->references('id')->on('retencion_fuentes');

            $table->integer('desc_municipal_id')->unsigned();
            $table->foreign('desc_municipal_id')->references('id')->on('desc_municipales');

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
        Schema::dropIfExists('orden_pagos_descuentos');
    }
}
