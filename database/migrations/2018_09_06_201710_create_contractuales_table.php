<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contractuales', function (Blueprint $table) {
       $table->increments('id');
       $table->string('modulo', 100);
       $table->string('responsable', 100);
       $table->date('ff_archivo')->nullable()->default(null);
       $table->integer('valor');
       $table->text('asunto')->nullable()->default(null);
       $table->unsignedInteger('idUsers');
       $table->foreign('idUsers')->references('id')->on('users');
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
      Schema::dropIfExists('contractuales');
    }
  }
