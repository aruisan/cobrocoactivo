<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcejalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concejales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partido');
            $table->string('periodo');

            $table->integer('dato_id')->unsigned()->nullable();
            $table->foreign('dato_id')->references('id')->on('personas');
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
        Schema::dropIfExists('concejales');
    }
}
