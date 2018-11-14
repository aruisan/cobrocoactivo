<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdpsRegistro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdps_registro', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cdp_id')->unsigned();
            $table->foreign('cdp_id')->references('id')->on('cdps');
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
        Schema::dropIfExists('cdps_registro');
    }
}
