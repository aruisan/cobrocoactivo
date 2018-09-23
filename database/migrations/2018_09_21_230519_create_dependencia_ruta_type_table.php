<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDependenciaRutaTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencia_ruta_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();            
            $table->integer('dependencia_id')->unsigned();            
            $table->integer('ruta_id')->unsigned();            
            $table->integer('dias');            
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('dependencia_id')->references('id')->on('dependencias');
            $table->foreign('ruta_id')->references('id')->on('rutas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependencia_ruta_type');
    }
}
