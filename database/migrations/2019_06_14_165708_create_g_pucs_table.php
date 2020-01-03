<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreategPucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                   
        Schema::create('g_pucs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',50);
            $table->string('name',400);
            $table->integer('parent');
            $table->integer('order');
            $table->integer('enable');
            $table->enum('type', ['1', '2']);
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
        Schema::dropIfExists('g_pucs');
    }
}
