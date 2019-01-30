<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosMovTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros_mov', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('valor');

            $table->integer('fonts_rubro_id')->unsigned();
            $table->foreign('fonts_rubro_id')->references('id')->on('fonts_rubro');
            $table->integer('fonts_id')->unsigned();
            $table->foreign('fonts_id')->references('id')->on('fonts');
            $table->integer('rubro_id')->unsigned();
            $table->foreign('rubro_id')->references('id')->on('rubros');
            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');

            $table->enum('movimiento', [0, 1, 2, 3]);

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
        Schema::dropIfExists('rubros_mov');
    }
}
