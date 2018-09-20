<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use App\Model\Hacienda\Presupuesto\CodePadre;


class RegistroController extends Controller
{
    public function create($vigencia, $level)
    {	
        $nivel = Level::where('vigencia_id', $vigencia)->where('level', $level)->first();
        $niveles = Level::where('vigencia_id', $vigencia)->get();
        
        if($nivel->level > 1){
            $level2 = $level-1;
    	   $nivel2 = Level::where('vigencia_id', $vigencia)->where('level', $level2)->first();
            $codes = Register::where('level_id', $nivel2->id)->get();

        }else{
            $codes = "";

        }

    	$conteo = Register::where('level_id', $nivel->id)->count();

        if($conteo == 0){
           $fila = $nivel->rows;
        }else if($conteo >= $nivel->rows){
            $fila = 0;
        }else if( $nivel->rows > $conteo){
            $fila = $nivel->rows - $conteo;
        }

        return view('hacienda.presupuesto.vigencia.createRegistros', compact('nivel', 'niveles', 'fila', 'codes'));
    }

    public function show($id)
    {
        $data = Register::where('level_id', $id)->get();

    	return $data;
    }




      public function store(Request $request)
    {
    	//dd($request->all());
    	if($request->level > 1){
    		$padre = $request->padre;
    	}else{
    		$padre = null;
    	}

        $id        = $request->register_id;
        $name      = $request->nombre;
        $code     = $request->code;
        $level_id  = $request->level_id;
        $level  = $request->level;
        $count = count($code);



        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $code[$i], $padre[$i], $level);
            }else{            
                $register = new Register();
                $register->name = $name[$i];
                $register->code = $code[$i];
                $register->register_id = $padre[$i];
                $register->level_id = $level_id;
                $register->save();
 
                if($level > 1){
                    $codePadre = new CodePadre();
                    $codePadre->register_id = $register->id;
                    $codePadre->register2_id = $padre[$i];
                    $codePadre->save();
                }
            }
        }

       return  back();
    }


    public function update($id, $name, $code, $padre, $level)
    {
        //dd($name);
        $register = Register::findOrFail($id);
        $register->name = $name;
        $register->code = $code;
        $register->register_id = $padre;
        $register->save();

        if($level > 1){
            $codePadre = CodePadre::where('register_id', $id)->first();
            $codePadre->register2_id = $padre;
            $codePadre->save();
        }
    }


    public function destroy($id)
    {
        $clienteplus = CodePadre::where('register_id', $id)->delete();
        $registro = Register::find($id);
        $registro->delete();
    }
}
