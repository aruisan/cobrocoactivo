<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdpsRegistroValor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdps_registro_valor', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('valor');
            $table->integer('rubros_cdp_valor_id')->unsigned();
            $table->foreign('rubros_cdp_valor_id')->references('id')->on('rubros_cdp_valor');
            $table->integer('cdps_registro_id')->unsigned();
            $table->foreign('cdps_registro_id')->references('id')->on('cdps_registro');
            $table->integer('registro_id')->unsigned();
            $table->foreign('registro_id')->references('id')->on('registros');

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
        Schema::dropIfExists('cdps_registro_valor');
    }
}
