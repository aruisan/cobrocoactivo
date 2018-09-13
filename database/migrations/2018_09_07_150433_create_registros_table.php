<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->text('objeto');
            $table->date('ff_expedicion');
            $table->string('ruta');
            $table->integer('valor');

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');

            $table->integer('cdp_id')->unsigned();
            $table->foreign('cdp_id')->references('id')->on('cdps');

            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contractuales');

            $table->enum('secretaria_e', [0, 1, 2, 3]);
            $table->enum('jcontratacion_e', [0, 1, 2, 3]);
            $table->enum('jpresupuesto_e', [0, 1, 2, 3]);

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
        Schema::dropIfExists('registros');
    }
}
