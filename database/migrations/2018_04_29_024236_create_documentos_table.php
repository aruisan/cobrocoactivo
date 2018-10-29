<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// tabla de recursos
class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');
            $table->timestamps();
        });


        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->date('ff_document');
            $table->date('ff_vence');
            $table->date('ff_salida');
            $table->date('ff_primerdbte');
            $table->date('ff_segundodbte');
            $table->date('ff_aprobacion');
            $table->date('ff_sancion');
            $table->enum('type',['Actas','Acuerdos','Resoluciones','Proyectos de acuerdo', 'Lista de empleados', 'Manual de contratación', 'Plan de adquisiones', 'Procesos de Contratación', 'Correspondencia entrada', 'Correspondencia salida', 'Otros documentos']);// campo referencia a las tablas cc 
            $table->integer('cc_id');
            $table->string('name');
            $table->integer('number_doc');
            $table->enum('estado',[0,1,2])->default(1);
            $table->string('respuesta');

            $table->integer('ponente_id')->nullable()->unsigned();
            $table->foreign('ponente_id')->references('id')->on('concejales');
            $table->integer('concejal_id')->nullable()->unsigned();
            $table->foreign('concejal_id')->references('id')->on('concejales');
            $table->integer('comision_id')->nullable()->unsigned();
            $table->foreign('comision_id')->references('id')->on('comisiones');
            $table->integer('resource_id')->nullable()->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('tercero_id')->nullable()->unsigned();
            $table->foreign('tercero_id')->references('id')->on('users');
            $table->timestamps();
        });


        /*tabla con la migracion  completa
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->date('ff_documento');
            $table->enum('tabla',['predios','juridicos','transitos','policivos']);// campo referencia a las tablas cc 
            $table->integer('cc_id');

            $table->integer('resource_id')->nullable()->unsigned();
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->timestamps();
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('resources');
    }
}
