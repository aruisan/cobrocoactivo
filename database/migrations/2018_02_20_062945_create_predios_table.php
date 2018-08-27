<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ficha_catastral', 40)->unique(); //este es el identificador nacional de un predio como la cedula de una persona en mi pais el dni en otros es la identificacion unico del predio a nivel nacional no se puede repetir
            $table->string('matricula_inmobiliaria', 40); //es otro identificador pero ya es cuando se matricula el predi
            $table->string('direccion_predio', 200);//direccion donde esta ubicado el predio
            $table->string('nombre_predio', 200);//algunos predios tiene nombre cmo hacienda la grande y es una finca
            $table->integer('a_hectareas');// area en hectareas ejemplo una finca tiene 32525 metros entoces aca se colocan solo 3 hectareas que son los 300000
            $table->integer('a_metros');//seguido del ejemplo anterior aca hiria en metros osea 2525 metros c
            $table->integer('a_construida');//en la finca tiene una casa de 283.5 metros cuadrados , aca hiria pues los 283.5 m", porq no se pone como float que agarra decimales ok dejalo decimal cual quier cosa lo cambiamos pero seria slo este y el de metros por que el de hectareas si va cerrado o es 1 o es 2 o  es 10 el resto se completa con  metros si me entiense si 
            //precio que le da la alcaldia que mas o menos vale su predio 30.000 dolares, te hablo en dolares pero aca es en cop = pesos colombianos
            $table->string('tipo_tarifa');// 
            $table->string('destino_economico');//
            $table->integer('porc_tarifa');//este se maneja con un boolean 0 y 1
            $table->string('expediente')->nullable();//  esto va en otra tabla


            $table->date('inicio');
            $table->date('final');

            //datos cambiables por año
            $table->integer('estrato'); // esto algo como las clases de las familias
            $table->text('observacion');// Observacion del predial
            $table->bigInteger('avaluo');                                
            $table->bigInteger('v_declarado');
            $table->bigInteger('impuesto_predial');
            $table->bigInteger('interes_predial');
            $table->bigInteger('contribucion_car');
            $table->bigInteger('interes_Car');
            $table->bigInteger('otros_conceptos');
            $table->bigInteger('cuantia');
            $table->integer('existe');
            $table->string('ubicacion');
            $table->string('exento');
            $table->integer('semaforo');
            $table->string('estado');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predios');
    }
}
