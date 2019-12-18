<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFontsRubroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonts_rubro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor');
            $table->bigInteger('valor_disp')->nullable();

            $table->integer('font_vigencia_id')->unsigned();
            $table->foreign('font_vigencia_id')->references('id')->on('fonts_vigencia');
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
        Schema::dropIfExists('fonts_rubro');
    }
}
