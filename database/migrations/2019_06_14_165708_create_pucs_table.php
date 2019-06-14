<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('codigo');
            $table->text('nombre_cuenta');
            $table->integer('codigo_NIPS');
            $table->text('nombre_NIPS');
            $table->integer('naturaleza');

            $table->integer('persona_id')->unsigned()->nullable();
            $table->foreign('persona_id')->references('id')->on('personas');

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
        Schema::dropIfExists('pucs');
    }
}
