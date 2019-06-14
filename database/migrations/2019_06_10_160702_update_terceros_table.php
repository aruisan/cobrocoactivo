<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTercerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personas', function(Blueprint $table){

            $table->enum('declarante', ['1', '0'])->nullable()->after('telefono');
            $table->enum('tipo_cc', ['NIT', 'CC'])->nullable()->after('declarante');
            $table->string('ciudad')->nullable()->after('tipo_cc');
            $table->string('regimen')->nullable()->after('ciudad');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personas', function(Blueprint $table){

            $table->dropColumn('declarante');
            $table->dropColumn('tipo_cc');
            $table->dropColumn('ciudad');
            $table->dropColumn('regimen');

        });
    }
}
