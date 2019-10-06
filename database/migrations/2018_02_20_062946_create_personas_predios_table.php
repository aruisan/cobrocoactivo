<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//personas dueñas de un predio
class CreatePersonasPrediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_predio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->integer('predio_id')->unsigned();
            $table->integer('porcentaje');
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('predio_id')->references('id')->on('predios');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_predio');
    }
}
