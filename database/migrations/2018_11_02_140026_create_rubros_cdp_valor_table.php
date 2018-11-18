<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosCdpValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros_cdp_valor', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('valor');
            $table->integer('fontsRubro_id')->unsigned();
            $table->foreign('fontsRubro_id')->references('id')->on('fonts_rubro');
            $table->integer('cdp_id')->unsigned();
            $table->foreign('cdp_id')->references('id')->on('cdps');
            $table->integer('rubrosCdp_id')->unsigned();
            $table->foreign('rubrosCdp_id')->references('id')->on('rubros_cdp');

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
        Schema::dropIfExists('rubros_cdp_valor');
    }
}
