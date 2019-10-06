<?php

use App\Model\Hacienda\Presupuesto\CodePadre;
use Illuminate\Database\Seeder;

class CodePadresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       CodePadre::create( [
        'id'=>1,
        'register_id'=>2,
        'register2_id'=>1,
        'created_at'=>'2019-02-04 20:49:37',
        'updated_at'=>'2019-02-04 20:49:37'
        ] );
              
        CodePadre::create( [
        'id'=>2,
        'register_id'=>3,
        'register2_id'=>2,
        'created_at'=>'2019-02-04 20:49:52',
        'updated_at'=>'2019-02-04 20:49:52'
        ] );
              
        CodePadre::create( [
        'id'=>3,
        'register_id'=>4,
        'register2_id'=>3,
        'created_at'=>'2019-02-04 20:50:31',
        'updated_at'=>'2019-02-04 20:50:31'
        ] );
              
        CodePadre::create( [
        'id'=>4,
        'register_id'=>5,
        'register2_id'=>3,
        'created_at'=>'2019-02-04 20:50:31',
        'updated_at'=>'2019-02-04 20:50:31'
        ] );
              
        CodePadre::create( [
        'id'=>5,
        'register_id'=>6,
        'register2_id'=>3,
        'created_at'=>'2019-02-04 20:50:31',
        'updated_at'=>'2019-02-04 20:50:31'
        ] );
              
        CodePadre::create( [
        'id'=>6,
        'register_id'=>7,
        'register2_id'=>4,
        'created_at'=>'2019-02-04 20:51:01',
        'updated_at'=>'2019-02-04 20:51:01'
        ] );
              
        CodePadre::create( [
        'id'=>7,
        'register_id'=>8,
        'register2_id'=>5,
        'created_at'=>'2019-02-04 20:51:01',
        'updated_at'=>'2019-02-04 20:51:01'
        ] );
              
        CodePadre::create( [
        'id'=>8,
        'register_id'=>9,
        'register2_id'=>6,
        'created_at'=>'2019-02-04 20:51:01',
        'updated_at'=>'2019-02-04 20:51:01'
        ] );
              
        CodePadre::create( [
        'id'=>9,
        'register_id'=>10,
        'register2_id'=>7,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
              
        CodePadre::create( [
        'id'=>10,
        'register_id'=>11,
        'register2_id'=>7,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
              
        CodePadre::create( [
        'id'=>11,
        'register_id'=>12,
        'register2_id'=>7,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
              
        CodePadre::create( [
        'id'=>12,
        'register_id'=>13,
        'register2_id'=>8,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
              
        CodePadre::create( [
        'id'=>13,
        'register_id'=>14,
        'register2_id'=>8,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
              
        CodePadre::create( [
        'id'=>14,
        'register_id'=>15,
        'register2_id'=>9,
        'created_at'=>'2019-02-04 20:51:57',
        'updated_at'=>'2019-02-04 20:51:57'
        ] );
    }
}
