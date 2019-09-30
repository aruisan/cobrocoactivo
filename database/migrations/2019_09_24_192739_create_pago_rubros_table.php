<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoRubrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_rubros', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pagos');

            $table->integer('rubro_id')->unsigned();
            $table->foreign('rubro_id')->references('id')->on('rubros');

            $table->integer('valor');

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
        Schema::dropIfExists('pago_rubros');
    }
}
