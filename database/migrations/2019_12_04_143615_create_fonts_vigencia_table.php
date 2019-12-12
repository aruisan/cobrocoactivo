<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFontsVigenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fonts_vigencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor');

            $table->integer('vigencia_id')->unsigned();
            $table->foreign('vigencia_id')->references('id')->on('vigencias');
            $table->integer('font_id')->unsigned();
            $table->foreign('font_id')->references('id')->on('fonts');
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
        Schema::dropIfExists('fonts_vigencia');
    }
}
