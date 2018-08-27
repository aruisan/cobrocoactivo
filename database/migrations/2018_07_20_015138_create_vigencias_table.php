<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVigenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vigencias', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('vigencia');
            $table->Integer('tipo');
            $table->char('numero_decreto')->nullable();
            $table->char('ruta')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('count')->default(0);
            $table->integer('ultimo');
            $table->bigInteger('presupuesto_inicial');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('vigencias');
    }
}
