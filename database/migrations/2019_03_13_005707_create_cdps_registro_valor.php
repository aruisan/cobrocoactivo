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
            $table->bigInteger('valor_disp')->nullable();
            $table->integer('fontsRubro_id')->unsigned();
            $table->foreign('fontsRubro_id')->references('id')->on('fonts_rubro');
            $table->integer('cdp_id')->unsigned();
            $table->foreign('cdp_id')->references('id')->on('cdps');
            $table->integer('registro_id')->unsigned();
            $table->foreign('registro_id')->references('id')->on('registros');
            $table->integer('rubro_id')->unsigned();
            $table->foreign('rubro_id')->references('id')->on('rubros');
            $table->integer('cdps_registro_id')->unsigned();
            $table->foreign('cdps_registro_id')->references('id')->on('cdps_registro');

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
