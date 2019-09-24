<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescMunicipalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desc_municipales', function (Blueprint $table) {
            $table->increments('id');

            $table->text('concepto');
            $table->integer('base')->nullable();
            $table->decimal('tarifa')->nullable();
            $table->integer('codigo');
            $table->text('cuenta');

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
        Schema::dropIfExists('desc_municipales');
    }
}
