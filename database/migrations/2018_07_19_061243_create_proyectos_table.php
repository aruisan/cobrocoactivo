<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->char('code');
            $table->integer('linea_base');
            $table->text('indicador');

            $table->integer('metaInicial');
            $table->integer('modificacion');
            $table->integer('metaDefinitiva');
           

            $table->integer('programa_id')->unsigned();
            $table->foreign('programa_id')->references('id')->on('programas'); 
            

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
        Schema::dropIfExists('proyectos');
    }
}
