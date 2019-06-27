<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelPUCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_pucs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->integer('level');
            $table->integer('cifras')->default(1);
            $table->integer('rows')->default(1);

            $table->integer('puc_id')->unsigned()->nullable();
            $table->foreign('puc_id')->references('id')->on('pucs');

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
        Schema::dropIfExists('level_pucs');
    }
}
