<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnexosContractualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_contractual', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->date('ff_doc');
            $table->integer('num_doc');
            $table->date('ff_vence');
            $table->integer('consecutivo')->nullable();
            $table->enum('estado',[0,1,2,3])->default(1);

            $table->integer('contractual_id')->nullable()->unsigned();
            $table->foreign('contractual_id')->references('id')->on('contractuales');
            $table->integer('resource_id')->nullable()->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');

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
        Schema::dropIfExists('anexos_contractual');
    }
}
