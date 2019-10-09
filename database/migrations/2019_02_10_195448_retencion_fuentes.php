<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RetencionFuentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('retencion_fuentes', function (Blueprint $table) {
        //     $table->increments('id');

        //     $table->text('concepto');
        //     $table->integer('uvt');
        //     $table->integer('base');
        //     $table->decimal('tarifa');
        //     $table->integer('codigo');
        //     $table->text('cuenta');

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retencion_fuentes');
    }
}
