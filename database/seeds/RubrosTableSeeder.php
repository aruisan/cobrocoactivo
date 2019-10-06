<?php

use App\Model\Admin\Dependencia;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Planeacion\Pdd\Eje;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Programa;
use App\Model\Planeacion\Pdd\Proyecto;
use App\Model\Planeacion\Pdd\SubProyecto;
use Illuminate\Database\Seeder;

class RubrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Pdd::create([
          'name' => 'Más Por Las Islas',
          'ff_inicio' => '2019-02-04',
          'ff_final' => '2021-02-04',
          'user_id' => 1,
          'ruta' => null,
       ]);         

       Dependencia::create([
          'name' => 'Concejo',
       ]);   

       Eje::create([
          'name' => 'CONCEJO MUNICIPAL',
          'pdd_id' => 1,
       ]);           

       Programa::create([
          'name' => 'CONCEJO MUNICIPAL',
          'eje_id' => 1,
       ]);     

       Proyecto::create([

          'name' => 'CONCEJO MUNICIPAL',
          'code' => 01,
          'linea_base' => 100,
          'indicador' => '100%',
          'metaInicial' => 100,
          'modificacion' => 0,
          'metaDefinitiva' => 0,
          'programa_id' => 1,
       ]);        

       SubProyecto::create([

          'name' => 'CONCEJO MUNICIPAL',
          'linea_base' => 100,
          'indicador' => '100%',
          'tipo' => 1,
          'unidad_medida' => 1,
          'proyecto_id' => 1,
          'dependencia_id' => 1,
       ]); 


       Rubro::create( [
        'id'=>1,
        'cod'=>'01',
        'name'=>'Sueldos Personal De Nomina',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>2,
        'cod'=>'02',
        'name'=>'Prima De Servicios',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>3,
        'cod'=>'03',
        'name'=>'Prima De Vacaciones',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>4,
        'cod'=>'04',
        'name'=>'Prima De Navidad',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>5,
        'cod'=>'05',
        'name'=>'Bonificacion Por Servicios Prestados',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>6,
        'cod'=>'06',
        'name'=>'Indemnización Vacacional',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>7,
        'cod'=>'07',
        'name'=>'Pagos Directos De Cesantias Parciales Y/o Definitivas E Interés De Cesantias',
        'register_id'=>10,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>8,
        'cod'=>'01',
        'name'=>'Honorarios A Concejales',
        'register_id'=>11,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>9,
        'cod'=>'02',
        'name'=>'Honorarios A Profesionales',
        'register_id'=>11,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>10,
        'cod'=>'03',
        'name'=>'Otros Gastos De Personal',
        'register_id'=>11,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>11,
        'cod'=>'01',
        'name'=>'Caja De Compensacion Familiar',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>12,
        'cod'=>'02',
        'name'=>'Fondo De Cesantias',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>13,
        'cod'=>'03',
        'name'=>'Salud Sector Público',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>14,
        'cod'=>'04',
        'name'=>'Pensiones Sector Privado',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>15,
        'cod'=>'05',
        'name'=>'A.R.P. Riesgos Profesionales',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>16,
        'cod'=>'06',
        'name'=>'I.C.B.F',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>17,
        'cod'=>'07',
        'name'=>'Instituto Tecnico Y Escuelas Industriales',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>18,
        'cod'=>'08',
        'name'=>'ESAP',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>19,
        'cod'=>'09',
        'name'=>'Sena',
        'register_id'=>12,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>20,
        'cod'=>'01',
        'name'=>'Compra De Equipo',
        'register_id'=>13,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>21,
        'cod'=>'02',
        'name'=>'Materiales y Suministros',
        'register_id'=>13,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>22,
        'cod'=>'01',
        'name'=>'Mantenimiento',
        'register_id'=>14,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>23,
        'cod'=>'02',
        'name'=>'Servicios Públicos',
        'register_id'=>14,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>24,
        'cod'=>'03',
        'name'=>'Seguros',
        'register_id'=>14,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>25,
        'cod'=>'04',
        'name'=>'Gastos De Viaje, Manutención, Alojamiento E Inscripciones Para Capacitación',
        'register_id'=>14,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>26,
        'cod'=>'05',
        'name'=>'Capacitación Y Bienestar Social',
        'register_id'=>14,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
        Rubro::create( [
        'id'=>27,
        'cod'=>'01',
        'name'=>'Federación Nacional de Concejos',
        'register_id'=>15,
        'subproyecto_id'=>1,
        'vigencia_id'=>1,
        'created_at'=>'2019-02-04 20:57:43',
        'updated_at'=>'2019-02-04 20:57:43'
        ] );
              
    }
}
