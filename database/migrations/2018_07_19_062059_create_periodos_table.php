<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('periodo', [1, 2, 3, 4]);
            $table->integer('metaInicial');
            $table->integer('modificacion');
            $table->integer('metaDefinitiva');
            $table->integer('valorInicial');

            $table->integer('subproyecto_id')->unsigned();
            $table->foreign('subproyecto_id')->references('id')->on('sub_proyectos');

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
        Schema::dropIfExists('periodos');
    }
}
