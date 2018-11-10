<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRubrosCdpValorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubros_cdp_valor', function (Blueprint $table) {

            $table->bigInteger('valor_disp')->nullable()->after('valor');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rubros_cdp_valor', function (Blueprint $table) {

            $table->dropColumn('valor_disp');
        });
    }
}
