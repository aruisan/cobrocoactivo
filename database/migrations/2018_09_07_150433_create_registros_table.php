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
            $table->integer('saldo');
            $table->integer('val_total')->nullable();
            $table->integer('iva')->nullable()->default(0);

            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');

            $table->string('tipo_doc');
            $table->integer('num_doc');
            $table->date('ff_doc');

            $table->enum('secretaria_e', [0, 1, 2, 3]);
            $table->date('ff_secretaria_e');

            $table->text('observacion')->nullable();

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
