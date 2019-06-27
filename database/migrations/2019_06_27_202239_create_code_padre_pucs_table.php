<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodePadrePucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_padre_pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('registers_puc_id')->unsigned();
            $table->foreign('registers_puc_id')->references('id')->on('registers_pucs');
            $table->integer('register2_puc_id')->unsigned();
            $table->foreign('register2_puc_id')->references('id')->on('registers_pucs');

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
        Schema::dropIfExists('code_padre_pucs');
    }
}
