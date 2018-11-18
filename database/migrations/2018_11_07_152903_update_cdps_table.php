<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCdpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cdps', function(Blueprint $table){

            $table->dropColumn('estado');
            $table->enum('secretaria_e', [0, 1, 2, 3])->after('ruta');
            $table->date('ff_secretaria_e')->after('secretaria_e');
            $table->enum('jefe_e', [0, 1, 2, 3])->nullable()->after('ff_secretaria_e');
            $table->date('ff_jefe_e')->nullable()->after('jefe_e');
            $table->text('motivo')->nullable()->after('ff_jefe_e');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cdps', function(Blueprint $table){

            $table->dropColumn('secretaria_e');
            $table->dropColumn('ff_secretaria_e');
            $table->dropColumn('jefe_e');
            $table->dropColumn('ff_jefe_e');
            $table->dropColumn('motivo');
            $table->string('estado')->nullable()->after('dependencia_id');


        });
    }
}
