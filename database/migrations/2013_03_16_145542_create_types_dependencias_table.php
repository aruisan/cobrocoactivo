<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/*
    la tabla types administra los tipos de usuarios en cobro coactivo.
    y dependencias son los departamentos de la empresa.
*/
class CreateTypesDependenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('asignar',[0,1])->default(0);
            $table->enum('expediente',[0,1])->default(0);
            $table->timestamps();
        });

        Schema::create('dependencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

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
        Schema::dropIfExists('types');
        Schema::dropIfExists('dependencias');
    }
}
