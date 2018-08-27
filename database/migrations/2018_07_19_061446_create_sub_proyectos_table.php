<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->integer('linea_base');
            $table->text('indicador');//puede estar volando
            $table->enum('tipo', [1, 2, 3]);
            $table->char('unidad_medida');


            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->integer('dependencia_id')->unsigned();
            $table->foreign('dependencia_id')->references('id')->on('dependencias');

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
        Schema::dropIfExists('sub_proyectos');
    }
}
