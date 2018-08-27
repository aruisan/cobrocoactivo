<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpulsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impulsos', function(Blueprint $table){
            $table->increments('id');
            $table->text('asunto');

            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('formato_impulso_id')->unsigned();
            $table->foreign('formato_impulso_id')->references('id')->on('formato_impulsos');

            $table->string('tabla');
            $table->integer('tabla_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
