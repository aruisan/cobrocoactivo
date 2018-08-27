<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->char('code');

            $table->integer('register_id')->unsigned()->nullable();
            $table->foreign('register_id')->references('id')->on('registers'); 
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');

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
        Schema::dropIfExists('registers');
    }
}
