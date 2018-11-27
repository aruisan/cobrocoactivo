<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFontsRubroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fonts_rubro', function(Blueprint $table){
            $table->integer('adicion')->nullable()->after('valor_disp');
            $table->integer('reduccion')->nullable()->after('adicion');
            $table->integer('credito')->nullable()->after('reduccion');
            $table->integer('ccredito')->nullable()->after('credito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fonts_rubro', function(Blueprint $table){
            $table->dropColumn('adicion');
            $table->dropColumn('reduccion');
            $table->dropColumn('credito');
            $table->dropColumn('ccredito');
        });
    }
}
