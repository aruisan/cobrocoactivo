<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 200);
            $table->string('ruta', 200);
            $table->date('ff_cargue', 200);
            $table->timestamps();
            $table->integer('proceso_id')->unsigned();
            $table->foreign('proceso_id')->references('id')->on('modulo_inicial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
