<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//tabla de modulos rellenos 
class CreateModuloInicialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_inicial', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modulo', 100);
            $table->string('responsable', 100)->nullable();
            $table->date('ff_archivo')->nullable();
            $table->integer('valor')->nullable();
            $table->text('asunto')->nullable();
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
        Schema::dropIfExists('modulo_inicial');
    }
}
