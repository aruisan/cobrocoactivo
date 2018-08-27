<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name')->nullable();
            $table->integer('level');
            $table->integer('cifras')->default(1);
            $table->integer('rows')->default(1);

            $table->integer('vigencia_id')->unsigned();
            $table->foreign('vigencia_id')->references('id')->on('vigencias');

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
        Schema::dropIfExists('levels');
    }
}
