<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');

            $table->timestamps();
        });
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('ff_documento');
            $table->enum('tabla',['predios','juridicos','transitos','policivos']);// campo referencia a las tablas cc 
            $table->integer('cc_id');

            $table->integer('resource_id')->nullable()->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
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
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('resources');
    }
}
