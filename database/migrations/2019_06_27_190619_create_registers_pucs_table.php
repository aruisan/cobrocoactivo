<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersPucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers_pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('code');

            $table->integer('registers_puc_id')->unsigned()->nullable();
            $table->foreign('registers_puc_id')->references('id')->on('registers_pucs');
            $table->integer('level_puc_id')->unsigned();
            $table->foreign('level_puc_id')->references('id')->on('level_pucs');

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
        Schema::dropIfExists('registers_pucs');
    }
}
