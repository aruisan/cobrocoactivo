<?php

use App\Model\Administrativo\Contabilidad\LevelPUC;
use App\Model\Administrativo\Contabilidad\Puc;
use App\Model\Administrativo\Contabilidad\RegistersPuc;
use Illuminate\Database\Seeder;

class RegisterPucsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        Puc::create([
            'vigencia' => 2019,
            'levels' => 4
        ]);

        LevelPUC::create( [
        'id'=>1,
        'name'=>'Nivel 1',
        'level'=>1,
        'cifras'=>1,
        'rows'=>5,
        'puc_id'=>1,
        'created_at'=>'2019-09-10 21:45:14',
        'updated_at'=>'2019-09-10 21:45:14'
        ] );
                    
        LevelPUC::create( [
        'id'=>2,
        'name'=>'Nivel 2',
        'level'=>2,
        'cifras'=>1,
        'rows'=>15,
        'puc_id'=>1,
        'created_at'=>'2019-09-10 21:45:14',
        'updated_at'=>'2019-09-10 21:45:14'
        ] );
                    
        LevelPUC::create( [
        'id'=>3,
        'name'=>'Nivel 3',
        'level'=>3,
        'cifras'=>2,
        'rows'=>39,
        'puc_id'=>1,
        'created_at'=>'2019-09-10 21:45:14',
        'updated_at'=>'2019-09-10 21:45:14'
        ] );
                    
        LevelPUC::create( [
        'id'=>4,
        'name'=>'Nivel 4',
        'level'=>4,
        'cifras'=>2,
        'rows'=>136,
        'puc_id'=>1,
        'created_at'=>'2019-09-10 21:45:14',
        'updated_at'=>'2019-09-10 21:45:14'
        ] );
        RegistersPuc::create( [
        'id'=>1,
        'name'=>'ACTIVOS',
        'code'=>'1',
        'register_puc_id'=>NULL,
        'level_puc_id'=>1,
        'created_at'=>'2019-09-10 21:47:18',
        'updated_at'=>'2019-09-10 21:47:18'
        ] );
              
        RegistersPuc::create( [
        'id'=>2,
        'name'=>'PASIVOS',
        'code'=>'2',
        'register_puc_id'=>NULL,
        'level_puc_id'=>1,
        'created_at'=>'2019-09-10 21:47:18',
        'updated_at'=>'2019-09-10 21:47:18'
        ] );
              
        RegistersPuc::create( [
        'id'=>3,
        'name'=>'PATRIMONIO',
        'code'=>'3',
        'register_puc_id'=>NULL,
        'level_puc_id'=>1,
        'created_at'=>'2019-09-10 21:47:18',
        'updated_at'=>'2019-09-10 21:47:18'
        ] );
              
        RegistersPuc::create( [
        'id'=>4,
        'name'=>'INGRESOS',
        'code'=>'4',
        'register_puc_id'=>NULL,
        'level_puc_id'=>1,
        'created_at'=>'2019-09-10 21:47:18',
        'updated_at'=>'2019-09-10 21:47:18'
        ] );
              
        RegistersPuc::create( [
        'id'=>5,
        'name'=>'GASTOS',
        'code'=>'5',
        'register_puc_id'=>NULL,
        'level_puc_id'=>1,
        'created_at'=>'2019-09-10 21:47:18',
        'updated_at'=>'2019-09-10 21:47:18'
        ] );
              
        RegistersPuc::create( [
        'id'=>6,
        'name'=>'EFECTIVO',
        'code'=>'1',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:47',
        'updated_at'=>'2019-09-10 21:52:47'
        ] );
              
        RegistersPuc::create( [
        'id'=>7,
        'name'=>'INVERSIONES E INSTRUMENTOS DERIVADOS',
        'code'=>'2',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:47',
        'updated_at'=>'2019-09-10 21:52:47'
        ] );
              
        RegistersPuc::create( [
        'id'=>8,
        'name'=>'CUENTAS POR PAGAR',
        'code'=>'3',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>9,
        'name'=>'PRESTAMOS POR COBRAR',
        'code'=>'4',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>10,
        'name'=>'INVENTARIOS',
        'code'=>'5',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>11,
        'name'=>'PROPIEDADES, PLANTA Y EQUIPO',
        'code'=>'6',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>12,
        'name'=>'BIENES DE BENEFICIO Y USO PUBLICO E HISTÓRICOS Y CULTURALES',
        'code'=>'7',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>13,
        'name'=>'OTROS ACTIVOS',
        'code'=>'9',
        'register_puc_id'=>1,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>14,
        'name'=>'CUENTAS POR PAGAR',
        'code'=>'4',
        'register_puc_id'=>2,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>15,
        'name'=>'BENEFICIOS A LOS EMPLEADOS',
        'code'=>'5',
        'register_puc_id'=>2,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>16,
        'name'=>'PROVISIONES',
        'code'=>'7',
        'register_puc_id'=>2,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>17,
        'name'=>'HACIENDA PUBLICA',
        'code'=>'1',
        'register_puc_id'=>3,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>18,
        'name'=>'TRANSFERENCIAS Y SUBVENCIONES',
        'code'=>'4',
        'register_puc_id'=>4,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>19,
        'name'=>'OTROS INGRESOS',
        'code'=>'8',
        'register_puc_id'=>4,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>20,
        'name'=>'DE ADMINISTRACIÓN Y OPERACIÓN',
        'code'=>'1',
        'register_puc_id'=>5,
        'level_puc_id'=>2,
        'created_at'=>'2019-09-10 21:52:48',
        'updated_at'=>'2019-09-10 21:52:48'
        ] );
              
        RegistersPuc::create( [
        'id'=>21,
        'name'=>'CAJA',
        'code'=>'05',
        'register_puc_id'=>6,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>22,
        'name'=>'DEPÓSITOS EN INSTITUCIONES FINANCIERAS',
        'code'=>'10',
        'register_puc_id'=>6,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>23,
        'name'=>'INVERSIONES DE LIQUIDEZ',
        'code'=>'11',
        'register_puc_id'=>7,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>24,
        'name'=>'TRANSFERENCIAS POR COBRAR',
        'code'=>'37',
        'register_puc_id'=>8,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>25,
        'name'=>'PRESTAMOS CONCEDIDOS',
        'code'=>'15',
        'register_puc_id'=>9,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>26,
        'name'=>'BIENES PRODUCIDOS',
        'code'=>'05',
        'register_puc_id'=>10,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>27,
        'name'=>'MUEBLES, ENSERES Y EQUIPO DE OFICINA',
        'code'=>'65',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>28,
        'name'=>'EQUIPOS DE COMUNICACION Y COMPUTACIÓN',
        'code'=>'70',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>29,
        'name'=>'EQUIPOS DE TRANSPORTE, TRACCION Y ELEVACION',
        'code'=>'75',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>30,
        'name'=>'EQUIPOS DE COMEDOR, COCINA, DESPENSA Y HOTELERIA',
        'code'=>'80',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>31,
        'name'=>'DEPRECIACION ACUMULADA (CR)',
        'code'=>'85',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>32,
        'name'=>'DETERIORO ACUMULADO DE PROPIEDADES, PLANTA Y EQUIPO (CR)',
        'code'=>'95',
        'register_puc_id'=>11,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>33,
        'name'=>'BIENES HISTÓRICOS Y CULTURALES',
        'code'=>'15',
        'register_puc_id'=>12,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>34,
        'name'=>'DEPRECIACIÓN ACUMULADA DE BIENES DE BENEFICIO Y USO PUBLICO (CR)',
        'code'=>'85',
        'register_puc_id'=>12,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>35,
        'name'=>'BIENES Y SERVICIOS PAGADOS POR ANTICIPADO',
        'code'=>'05',
        'register_puc_id'=>13,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>36,
        'name'=>'AVANCES Y ANTICIPOS ENTREGADOS',
        'code'=>'06',
        'register_puc_id'=>13,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>37,
        'name'=>'ANTICIPOS, RETENCIONES Y SALDOS A FAVOR POR IMPUESTOS',
        'code'=>'07',
        'register_puc_id'=>13,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>38,
        'name'=>'ACTIVOS INTANGIBLES',
        'code'=>'70',
        'register_puc_id'=>13,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>39,
        'name'=>'ADQUISICION DE BIENES Y SERVICIOS NACIONALES',
        'code'=>'01',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>40,
        'name'=>'RECURSOS A FAVOR DE TERCEROS',
        'code'=>'07',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>41,
        'name'=>'DESCUENTOS DE NÓMINA',
        'code'=>'24',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>42,
        'name'=>'RETENCIÓN EN LA FUENTE E IMPUESTO DE TIMBRE',
        'code'=>'36',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>43,
        'name'=>'IMPUESTOS, CONTRIBUCIONES Y TASAS',
        'code'=>'40',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>44,
        'name'=>'OTRAS CUENTAS POR PAGAR',
        'code'=>'90',
        'register_puc_id'=>14,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>45,
        'name'=>'SALARIOS Y PRESTACIONES SOCIALES',
        'code'=>'05',
        'register_puc_id'=>15,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>46,
        'name'=>'LITIGIOS Y DEMANDAS',
        'code'=>'01',
        'register_puc_id'=>16,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>47,
        'name'=>'BONOS PENSIONALES',
        'code'=>'19',
        'register_puc_id'=>16,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>48,
        'name'=>'CAPITAL FISCAL',
        'code'=>'05',
        'register_puc_id'=>17,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>49,
        'name'=>'RESULTADO DE EJERCICIOS ANTERIORES',
        'code'=>'09',
        'register_puc_id'=>17,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>50,
        'name'=>'RESULTADO DEL EJERCICIO',
        'code'=>'10',
        'register_puc_id'=>17,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>51,
        'name'=>'OTRAS TRANSFERENCIAS',
        'code'=>'28',
        'register_puc_id'=>18,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>52,
        'name'=>'FINANCIEROS',
        'code'=>'02',
        'register_puc_id'=>19,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>53,
        'name'=>'INGRESOS DIVERSOS',
        'code'=>'08',
        'register_puc_id'=>19,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>54,
        'name'=>'SUELDOS Y SALARIOS',
        'code'=>'01',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>55,
        'name'=>'CONTRIBUCIONES IMPUTADAS',
        'code'=>'02',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>56,
        'name'=>'APORTES SOBRE LA NÓMINA',
        'code'=>'04',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>57,
        'name'=>'PRESTACIONES SOCIALES',
        'code'=>'07',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>58,
        'name'=>'GASTOS DE PERSONAL DIVERSOS',
        'code'=>'08',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>59,
        'name'=>'GENERALES',
        'code'=>'11',
        'register_puc_id'=>20,
        'level_puc_id'=>3,
        'created_at'=>'2019-09-10 22:17:00',
        'updated_at'=>'2019-09-10 22:17:00'
        ] );
              
        RegistersPuc::create( [
        'id'=>60,
        'name'=>'CAJA MENOR',
        'code'=>'02',
        'register_puc_id'=>21,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>61,
        'name'=>'CUENTA CORRIENTE',
        'code'=>'05',
        'register_puc_id'=>22,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>62,
        'name'=>'CUENTA DE AHORRO',
        'code'=>'06',
        'register_puc_id'=>22,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>63,
        'name'=>'OTROS CERTIFICADOS',
        'code'=>'45',
        'register_puc_id'=>23,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>64,
        'name'=>'PAGARÉS',
        'code'=>'47',
        'register_puc_id'=>23,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>65,
        'name'=>'OTRAS TRANSFERENCIAS POR COBRAR',
        'code'=>'12',
        'register_puc_id'=>24,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>66,
        'name'=>'PRÉSTAMOS DE VIVIENDA',
        'code'=>'20',
        'register_puc_id'=>25,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>67,
        'name'=>'OTROS BIENES PRODUCIDOS',
        'code'=>'90',
        'register_puc_id'=>26,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>68,
        'name'=>'MUEBLES Y ENSERES',
        'code'=>'01',
        'register_puc_id'=>27,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>69,
        'name'=>'EQUIPO Y MAQUINA DE OFICINA',
        'code'=>'02',
        'register_puc_id'=>27,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>70,
        'name'=>'OTROS MUEBLES, ENSERES Y EQUIPO DE OFICINA',
        'code'=>'90',
        'register_puc_id'=>27,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>71,
        'name'=>'EQUIPO DE COMUNICACIÓN',
        'code'=>'01',
        'register_puc_id'=>28,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>72,
        'name'=>'EQUIPO DE COMPUTACIÓN',
        'code'=>'02',
        'register_puc_id'=>28,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>73,
        'name'=>'TERRESTRE',
        'code'=>'02',
        'register_puc_id'=>29,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>74,
        'name'=>'EQUIPO DE RESTAURANTE Y CAFETERÍA',
        'code'=>'02',
        'register_puc_id'=>30,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>75,
        'name'=>'MUEBLES, ENSERES Y EQUIPO DE OFICINA',
        'code'=>'06',
        'register_puc_id'=>31,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>76,
        'name'=>'EQUIPOS DE COMUNICACION Y COMPUTACION',
        'code'=>'07',
        'register_puc_id'=>31,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>77,
        'name'=>'EQUIPOS DE TRANSPORTE, TRACCION Y ELEVACIÓN',
        'code'=>'08',
        'register_puc_id'=>31,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>78,
        'name'=>'EQUIPOS DE COMEDOR, COCINA, DESPENSA Y HOTELERIA',
        'code'=>'09',
        'register_puc_id'=>31,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>79,
        'name'=>'MUEBLES, ENSERES Y EQUIPO DE OFICINA',
        'code'=>'10',
        'register_puc_id'=>32,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>80,
        'name'=>'EQUIPOS DE COMUNICACION Y COMPUTACIÓN',
        'code'=>'11',
        'register_puc_id'=>32,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>81,
        'name'=>'EQUIPO DE TRANSPORTE, TRACCION Y ELEVACIÓN',
        'code'=>'12',
        'register_puc_id'=>32,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>82,
        'name'=>'EQUIPOS DE COMEDOR, COCINA, DESPENSA Y HOTELERIA',
        'code'=>'13',
        'register_puc_id'=>32,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>83,
        'name'=>'OBRAS DE ARTE',
        'code'=>'03',
        'register_puc_id'=>33,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>84,
        'name'=>'OTROS BIENES DE BENEFICIO Y USO PUBLICO',
        'code'=>'90',
        'register_puc_id'=>34,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>85,
        'name'=>'SEGUROS',
        'code'=>'01',
        'register_puc_id'=>35,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>86,
        'name'=>'ANTICIPOS SOBRE CONVENIOS Y ACUERDOS',
        'code'=>'01',
        'register_puc_id'=>36,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>87,
        'name'=>'RETENCIÓN EN LA FUENTE',
        'code'=>'02',
        'register_puc_id'=>37,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>88,
        'name'=>'DERECHOS',
        'code'=>'05',
        'register_puc_id'=>38,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>89,
        'name'=>'LICENCIAS',
        'code'=>'07',
        'register_puc_id'=>38,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>90,
        'name'=>'SOFTWARES',
        'code'=>'08',
        'register_puc_id'=>38,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>91,
        'name'=>'ACTIVOS INTANGIBLES EN FASE DE DESARROLLO',
        'code'=>'10',
        'register_puc_id'=>38,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>92,
        'name'=>'BIENES Y SERVICIOS',
        'code'=>'01',
        'register_puc_id'=>39,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>93,
        'name'=>'VENTAS POR CUENTA DE TERCEROS',
        'code'=>'04',
        'register_puc_id'=>40,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>94,
        'name'=>'APORTES A FONDOS PENSIONALES',
        'code'=>'01',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>95,
        'name'=>'APORTES A SEGURIDAD SOCIAL EN SALUD',
        'code'=>'02',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>96,
        'name'=>'LIBRANZAS',
        'code'=>'07',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>97,
        'name'=>'EMBARGOS JUDICIALES',
        'code'=>'11',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>98,
        'name'=>'SENA',
        'code'=>'12',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>99,
        'name'=>'ICBF',
        'code'=>'13',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>100,
        'name'=>'CAJAS DE COMPENSACIÓN',
        'code'=>'14',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>101,
        'name'=>'OTROS DESCUENTOS DE NOMINA',
        'code'=>'90',
        'register_puc_id'=>41,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>102,
        'name'=>'DIVIDENDOS Y PARTICIPACIONES',
        'code'=>'02',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>103,
        'name'=>'HONORARIOS',
        'code'=>'03',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>104,
        'name'=>'COMISIONES',
        'code'=>'04',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>105,
        'name'=>'SERVICIOS',
        'code'=>'05',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>106,
        'name'=>'RENDIMIENTOS FINANCIEROS E INTERESES',
        'code'=>'06',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>107,
        'name'=>'COMPRAS',
        'code'=>'07',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>108,
        'name'=>'LOTERÍAS, RIFAS, APUESTAS Y SIMILARES',
        'code'=>'09',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>109,
        'name'=>'PAGOS O ABONOS EN CUENTAS EN EL EXTERIOR',
        'code'=>'10',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>110,
        'name'=>'IMPUESTO A LAS VENTAS RETENIDO',
        'code'=>'25',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>111,
        'name'=>'CONTRATOS DE CONSTRUCCIÓN',
        'code'=>'26',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>112,
        'name'=>'RETENCIÓN DE IMPUESTO DE INDUSTRIA Y COMERCIO POR COMPRAS',
        'code'=>'27',
        'register_puc_id'=>42,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>113,
        'name'=>'CUOTA DE FISCALIZACIÓN Y AUDITAJE',
        'code'=>'14',
        'register_puc_id'=>43,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>114,
        'name'=>'SUSCRIPCIONES',
        'code'=>'26',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>115,
        'name'=>'VIÁTICOS Y GASTOS DE VIAJE',
        'code'=>'27',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>116,
        'name'=>'SEGUROS',
        'code'=>'28',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>117,
        'name'=>'GASTOS LEGALES',
        'code'=>'31',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>118,
        'name'=>'APORTES AL ICBF Y SENA',
        'code'=>'50',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>119,
        'name'=>'SERVICIOS PÚBLICOS',
        'code'=>'51',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>120,
        'name'=>'COMISIONES',
        'code'=>'53',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>121,
        'name'=>'HONORARIOS',
        'code'=>'54',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>122,
        'name'=>'SERVICIOS',
        'code'=>'55',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>123,
        'name'=>'EXCEDENTES FINANCIEROS',
        'code'=>'57',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>124,
        'name'=>'ARRENDAMIENTO OPERATIVO',
        'code'=>'58',
        'register_puc_id'=>44,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>125,
        'name'=>'NÓMINA POR PAGAR',
        'code'=>'01',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>126,
        'name'=>'CESANTÍAS',
        'code'=>'02',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>127,
        'name'=>'INTERESES POR CESANTÍAS',
        'code'=>'03',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>128,
        'name'=>'VACACIONES',
        'code'=>'04',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>129,
        'name'=>'PRIMA DE VACACIONES',
        'code'=>'05',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>130,
        'name'=>'PRIMA DE SERVICIOS',
        'code'=>'06',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>131,
        'name'=>'PRIMA DE NAVIDAD',
        'code'=>'07',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>132,
        'name'=>'LICENCIAS',
        'code'=>'08',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>133,
        'name'=>'BONIFICACIONES',
        'code'=>'09',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>134,
        'name'=>'OTRAS PRIMAS',
        'code'=>'10',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>135,
        'name'=>'APORTES A RIESGOS LABORALES',
        'code'=>'11',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>136,
        'name'=>'AUXILIOS FUNERARIOS',
        'code'=>'12',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>137,
        'name'=>'REMUNERACIÓN POR SERVICIOS TÉCNICOS',
        'code'=>'13',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>138,
        'name'=>'CAPACITACIÓN, BIENESTAR SOCIAL Y ESTÍMULOS',
        'code'=>'15',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>139,
        'name'=>'DOTACIÓN Y SUMINISTRO A TRABAJADORES',
        'code'=>'16',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>140,
        'name'=>'GASTOS DEPORTIVOS Y RECREACIÓN',
        'code'=>'17',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>141,
        'name'=>'CONTRATOS DE PERSONAL TEMPORAL',
        'code'=>'18',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>142,
        'name'=>'GASTOS DE VIAJE',
        'code'=>'19',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>143,
        'name'=>'COMISIONES',
        'code'=>'20',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>144,
        'name'=>'APORTES A FONDOS PENSIONALES - EMPLEADOR',
        'code'=>'22',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>145,
        'name'=>'APORTES A SEGURIDAD SOCIAL EN SALUD - EMPLEADOR',
        'code'=>'23',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>146,
        'name'=>'APORTES A CAJAS DE COMPENSACIÓN FAMILIAR',
        'code'=>'24',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>147,
        'name'=>'INCAPACIDADES',
        'code'=>'26',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>148,
        'name'=>'OTROS BENEFICIOS A LOS EMPLEADOS A CORTO PLAZO',
        'code'=>'90',
        'register_puc_id'=>45,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>149,
        'name'=>'CIVILES',
        'code'=>'01',
        'register_puc_id'=>46,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>150,
        'name'=>'ADMINISTRATIVAS',
        'code'=>'03',
        'register_puc_id'=>46,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>151,
        'name'=>'LABORALES',
        'code'=>'05',
        'register_puc_id'=>46,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>152,
        'name'=>'CUOTAS PARTES DE BONOS PENSIONALES EMITIDOS',
        'code'=>'01',
        'register_puc_id'=>47,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>153,
        'name'=>'CAPITAL FISCAL',
        'code'=>'06',
        'register_puc_id'=>48,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>154,
        'name'=>'UTILIDADES O EXCEDENTES ACUMULADOS',
        'code'=>'01',
        'register_puc_id'=>49,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>155,
        'name'=>'PÉRDIDAS O DÉFICITS ACUMULADOS',
        'code'=>'02',
        'register_puc_id'=>49,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>156,
        'name'=>'UTILIDADES O EXCEDENTES ACUMULADOS',
        'code'=>'01',
        'register_puc_id'=>50,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>157,
        'name'=>'PÉRDIDAS O DÉFICITS ACUMULADOS',
        'code'=>'02',
        'register_puc_id'=>50,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>158,
        'name'=>'PARA GASTOS DE FUNCIONAMIENTO',
        'code'=>'03',
        'register_puc_id'=>51,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>159,
        'name'=>'INTERESES SOBRE DEPÓSITOS EN INSTITUCIONES FINANCIERAS',
        'code'=>'01',
        'register_puc_id'=>52,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>160,
        'name'=>'FOTOCOPIAS',
        'code'=>'15',
        'register_puc_id'=>53,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>161,
        'name'=>'SUELDOS',
        'code'=>'01',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>162,
        'name'=>'HORAS EXTRAS Y FESTIVOS',
        'code'=>'03',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>163,
        'name'=>'GASTOS DE REPRESENTACIÓN',
        'code'=>'05',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>164,
        'name'=>'SUELDO POR COMISIONES AL EXTERIOR',
        'code'=>'08',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>165,
        'name'=>'PRIMA TECNICA',
        'code'=>'10',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>166,
        'name'=>'BONIFICACIONES',
        'code'=>'19',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>167,
        'name'=>'AUXILIO DE TRANSPORTE',
        'code'=>'23',
        'register_puc_id'=>54,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>168,
        'name'=>'INCAPACIDADES',
        'code'=>'02',
        'register_puc_id'=>55,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>169,
        'name'=>'SUBSIDIO FAMILIAR',
        'code'=>'01',
        'register_puc_id'=>55,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>170,
        'name'=>'APORTES AL ICBF',
        'code'=>'01',
        'register_puc_id'=>56,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>171,
        'name'=>'APORTES AL ICBF',
        'code'=>'02',
        'register_puc_id'=>56,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>172,
        'name'=>'APORTES AL ESAP',
        'code'=>'03',
        'register_puc_id'=>56,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>173,
        'name'=>'APORTES A ESCUELAS INDUSTRIALES E INSTITUTOS TÉCNICOS',
        'code'=>'04',
        'register_puc_id'=>56,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>174,
        'name'=>'VACACIONES',
        'code'=>'01',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>175,
        'name'=>'CESANTÍAS',
        'code'=>'02',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>176,
        'name'=>'INTERESES A LAS CESANTÍAS',
        'code'=>'03',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>177,
        'name'=>'PRIMA DE VACACIONES',
        'code'=>'04',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>178,
        'name'=>'PRIMA DE NAVIDAD',
        'code'=>'05',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>179,
        'name'=>'PRIMA DE SERVICIOS',
        'code'=>'06',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>180,
        'name'=>'BONIFICACIÓN ESPECIAL DE RECREACIÓN',
        'code'=>'07',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>181,
        'name'=>'CESANTÍAS RETROACTIVAS',
        'code'=>'08',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>182,
        'name'=>'OTRAS PRIMAS',
        'code'=>'90',
        'register_puc_id'=>57,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>183,
        'name'=>'REMUNERACIÓN POR SERVICIOS TÉCNICOS',
        'code'=>'01',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>184,
        'name'=>'HONORARIOS',
        'code'=>'02',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>185,
        'name'=>'CAPACITACIÓN, BIENESTAR SOCIAL Y ESTÍMULOS',
        'code'=>'03',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>186,
        'name'=>'DOTACIÓN Y SUMINISTRO A TRABAJADORES',
        'code'=>'04',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>187,
        'name'=>'GASTOS DE VIAJE',
        'code'=>'07',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>188,
        'name'=>'VIÁTICOS',
        'code'=>'10',
        'register_puc_id'=>58,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>189,
        'name'=>'MATERIALES Y SUMINISTRO',
        'code'=>'14',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>190,
        'name'=>'MANTENIMIENTO',
        'code'=>'15',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>191,
        'name'=>'REPARACIONES',
        'code'=>'16',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>192,
        'name'=>'SERVICIOS PÚBLICOS',
        'code'=>'17',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>193,
        'name'=>'VIÁTICOS Y GASTOS DE VIAJE',
        'code'=>'19',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>194,
        'name'=>'PUBLICIDAD Y PROPAGANDA',
        'code'=>'20',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
              
        RegistersPuc::create( [
        'id'=>195,
        'name'=>'FOTOCOPIAS',
        'code'=>'22',
        'register_puc_id'=>59,
        'level_puc_id'=>4,
        'created_at'=>'2019-09-10 23:20:55',
        'updated_at'=>'2019-09-10 23:20:55'
        ] );
    }
}
