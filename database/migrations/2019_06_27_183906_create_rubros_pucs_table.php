<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubrosPucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubros_pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->char('codigo');
            $table->text('nombre_cuenta');
            $table->integer('codigo_NIPS')->nullable();
            $table->text('nombre_NIPS')->nullable();
            $table->integer('naturaleza')->nullable();

            $table->integer('persona_id')->unsigned()->nullable();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->integer('puc_id')->unsigned()->nullable();
            $table->foreign('puc_id')->references('id')->on('pucs');
            $table->integer('register_puc_id')->unsigned()->nullable();
            $table->foreign('register_puc_id')->references('id')->on('registers_pucs');

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
        Schema::dropIfExists('rubros_pucs');
    }
}
