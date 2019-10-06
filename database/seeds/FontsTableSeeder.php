<?php

use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use Illuminate\Database\Seeder;

class FontsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Font::create([
           'name' => 'Recursos Propios',
           'code' => 01,
           'valor' => 993989772,
           'vigencia_id' => 1,
        ]);



        FontsRubro::create( [
        'id'=>1,
        'valor'=>36633241,
        'valor_disp'=>10918868,
        'font_id'=>1,
        'rubro_id'=>1,
        'created_at'=>'2019-02-04 20:57:55',
        'updated_at'=>'2019-09-06 22:33:19'
        ] );
              
        FontsRubro::create( [
        'id'=>2,
        'valor'=>1683112,
        'valor_disp'=>223746,
        'font_id'=>1,
        'rubro_id'=>2,
        'created_at'=>'2019-02-04 20:58:11',
        'updated_at'=>'2019-07-18 16:12:39'
        ] );
              
        FontsRubro::create( [
        'id'=>3,
        'valor'=>1605302,
        'valor_disp'=>80264,
        'font_id'=>1,
        'rubro_id'=>3,
        'created_at'=>'2019-02-04 20:58:26',
        'updated_at'=>'2019-07-30 17:21:07'
        ] );
              
        FontsRubro::create( [
        'id'=>4,
        'valor'=>3346150,
        'valor_disp'=>3346150,
        'font_id'=>1,
        'rubro_id'=>4,
        'created_at'=>'2019-02-04 20:58:43',
        'updated_at'=>'2019-02-04 20:58:43'
        ] );
              
        FontsRubro::create( [
        'id'=>5,
        'valor'=>1098996,
        'valor_disp'=>146095,
        'font_id'=>1,
        'rubro_id'=>5,
        'created_at'=>'2019-02-04 20:58:55',
        'updated_at'=>'2019-03-20 17:05:51'
        ] );
              
        FontsRubro::create( [
        'id'=>6,
        'valor'=>2354443,
        'valor_disp'=>219408,
        'font_id'=>1,
        'rubro_id'=>6,
        'created_at'=>'2019-02-04 20:59:12',
        'updated_at'=>'2019-07-30 17:21:05'
        ] );
              
        FontsRubro::create( [
        'id'=>7,
        'valor'=>494742,
        'valor_disp'=>99497,
        'font_id'=>1,
        'rubro_id'=>7,
        'created_at'=>'2019-02-04 20:59:26',
        'updated_at'=>'2019-03-04 21:48:52'
        ] );
              
        FontsRubro::create( [
        'id'=>8,
        'valor'=>129884882,
        'valor_disp'=>40091822,
        'font_id'=>1,
        'rubro_id'=>8,
        'created_at'=>'2019-02-04 20:59:43',
        'updated_at'=>'2019-09-06 22:33:16'
        ] );
              
        FontsRubro::create( [
        'id'=>9,
        'valor'=>60000000,
        'valor_disp'=>200000,
        'font_id'=>1,
        'rubro_id'=>9,
        'created_at'=>'2019-02-04 20:59:57',
        'updated_at'=>'2019-07-18 16:13:33'
        ] );
              
        FontsRubro::create( [
        'id'=>10,
        'valor'=>32670000,
        'valor_disp'=>14150000,
        'font_id'=>1,
        'rubro_id'=>10,
        'created_at'=>'2019-02-04 21:00:12',
        'updated_at'=>'2019-07-18 16:12:09'
        ] );
              
        FontsRubro::create( [
        'id'=>11,
        'valor'=>1465328,
        'valor_disp'=>578628,
        'font_id'=>1,
        'rubro_id'=>11,
        'created_at'=>'2019-02-04 21:00:29',
        'updated_at'=>'2019-09-06 22:33:26'
        ] );
              
        FontsRubro::create( [
        'id'=>12,
        'valor'=>3554568,
        'valor_disp'=>260860,
        'font_id'=>1,
        'rubro_id'=>12,
        'created_at'=>'2019-02-04 21:00:41',
        'updated_at'=>'2019-03-04 21:47:14'
        ] );
              
        FontsRubro::create( [
        'id'=>13,
        'valor'=>3113826,
        'valor_disp'=>1230653,
        'font_id'=>1,
        'rubro_id'=>13,
        'created_at'=>'2019-02-04 21:00:55',
        'updated_at'=>'2019-09-06 22:33:22'
        ] );
              
        FontsRubro::create( [
        'id'=>14,
        'valor'=>4395989,
        'valor_disp'=>1737516,
        'font_id'=>1,
        'rubro_id'=>14,
        'created_at'=>'2019-02-04 21:01:08',
        'updated_at'=>'2019-09-06 22:33:24'
        ] );
              
        FontsRubro::create( [
        'id'=>15,
        'valor'=>820513,
        'valor_disp'=>280413,
        'font_id'=>1,
        'rubro_id'=>15,
        'created_at'=>'2019-02-04 21:01:20',
        'updated_at'=>'2019-09-06 22:33:28'
        ] );
              
        FontsRubro::create( [
        'id'=>16,
        'valor'=>1098996,
        'valor_disp'=>434296,
        'font_id'=>1,
        'rubro_id'=>16,
        'created_at'=>'2019-02-04 21:01:33',
        'updated_at'=>'2019-09-06 22:33:32'
        ] );
              
        FontsRubro::create( [
        'id'=>17,
        'valor'=>366331,
        'valor_disp'=>144331,
        'font_id'=>1,
        'rubro_id'=>17,
        'created_at'=>'2019-02-04 21:01:47',
        'updated_at'=>'2019-09-06 22:33:38'
        ] );
              
        FontsRubro::create( [
        'id'=>18,
        'valor'=>183166,
        'valor_disp'=>58066,
        'font_id'=>1,
        'rubro_id'=>18,
        'created_at'=>'2019-02-04 21:01:59',
        'updated_at'=>'2019-09-06 22:33:35'
        ] );
              
        FontsRubro::create( [
        'id'=>19,
        'valor'=>183166,
        'valor_disp'=>71766,
        'font_id'=>1,
        'rubro_id'=>19,
        'created_at'=>'2019-02-04 21:02:19',
        'updated_at'=>'2019-09-06 22:33:30'
        ] );
              
        FontsRubro::create( [
        'id'=>20,
        'valor'=>40000000,
        'valor_disp'=>30000000,
        'font_id'=>1,
        'rubro_id'=>20,
        'created_at'=>'2019-02-04 21:02:37',
        'updated_at'=>'2019-02-05 14:42:12'
        ] );
              
        FontsRubro::create( [
        'id'=>21,
        'valor'=>70000000,
        'valor_disp'=>6000000,
        'font_id'=>1,
        'rubro_id'=>21,
        'created_at'=>'2019-02-04 21:02:52',
        'updated_at'=>'2019-02-05 14:43:38'
        ] );
              
        FontsRubro::create( [
        'id'=>22,
        'valor'=>40000000,
        'valor_disp'=>0,
        'font_id'=>1,
        'rubro_id'=>22,
        'created_at'=>'2019-02-04 21:03:05',
        'updated_at'=>'2019-07-18 16:12:37'
        ] );
              
        FontsRubro::create( [
        'id'=>23,
        'valor'=>35000000,
        'valor_disp'=>8279161,
        'font_id'=>1,
        'rubro_id'=>23,
        'created_at'=>'2019-02-04 21:03:18',
        'updated_at'=>'2019-09-06 22:33:13'
        ] );
              
        FontsRubro::create( [
        'id'=>24,
        'valor'=>2500000,
        'valor_disp'=>0,
        'font_id'=>1,
        'rubro_id'=>24,
        'created_at'=>'2019-02-04 21:03:30',
        'updated_at'=>'2019-07-31 15:57:12'
        ] );
              
        FontsRubro::create( [
        'id'=>25,
        'valor'=>200000000,
        'valor_disp'=>141707862,
        'font_id'=>1,
        'rubro_id'=>25,
        'created_at'=>'2019-02-04 21:03:43',
        'updated_at'=>'2019-09-06 22:33:00'
        ] );
              
        FontsRubro::create( [
        'id'=>26,
        'valor'=>306537021,
        'valor_disp'=>67798677,
        'font_id'=>1,
        'rubro_id'=>26,
        'created_at'=>'2019-02-04 21:03:57',
        'updated_at'=>'2019-09-06 22:32:37'
        ] );
              
        FontsRubro::create( [
        'id'=>27,
        'valor'=>1500000,
        'valor_disp'=>500000,
        'font_id'=>1,
        'rubro_id'=>27,
        'created_at'=>'2019-02-04 21:04:10',
        'updated_at'=>'2019-07-30 17:21:01'
        ] );
    }
}
