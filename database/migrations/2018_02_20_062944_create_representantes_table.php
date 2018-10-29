<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
    relaciona a personas naturales dueñas de una persona juridica
*/
class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('representantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rep_id')->unsigned();
            $table->foreign('rep_id')->references('id')->on('personas');
            $table->integer('juridico_id')->unsigned();
            $table->foreign('juridico_id')->references('id')->on('personas');
            $table->timestamps();
            $table->softDeletes();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('representantes');
    }
}
