<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosCdpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros_cdp', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cdp_id')->unsigned();
            $table->foreign('cdp_id')->references('id')->on('cdps');
            $table->integer('rubro_id')->unsigned();
            $table->foreign('rubro_id')->references('id')->on('rubros');

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
        Schema::dropIfExists('rubros_cdp');
    }
}
