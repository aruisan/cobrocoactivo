<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vigencia;
use App\User;
use App\Traits\FileTraits;
use Session;

class VigenciaController extends Controller
{

	 public function create($tipo)
    {
    	return view('presupuesto.vigencia.create', compact('tipo'));
    }

    public function store(Request $request){

        //dd(public_path());
        $user = User::all()->count();
        if($user == 0){
            Session::flash('error','Debe crear un usuario para anexarlo a la vigencia');
            return back();
        }

        $duple = Vigencia::where('tipo', $request->tipo)->where('vigencia', $request->vigencia)->get()->count();
        if($duple < 1){
            if($request->hasFile('file'))
            {
                $file = new FileTraits;
                $ruta = $file->File($request->file('file'));
            }else{
                $ruta = "";
            }

        	$vigencia = new Vigencia;
            $vigencia->vigencia = $request->vigencia;
            $vigencia->tipo = $request->tipo;
            $vigencia->ultimo = $request->niveles;
            $vigencia->presupuesto_inicial = $request->valor;
            $vigencia->ruta = $ruta;
            $vigencia->numero_decreto = $request->decreto;
            $vigencia->fecha = $request->fecha;
            $vigencia->user_id = 1;
            $vigencia->save();

            Session::flash('success','La Vigencia se ha creado exitosamente');
            return redirect('/level/create/'.$vigencia->id);
        }else{
            Session::flash('error','La Vigencia no se puede duplicar');
            return back();
        }

    } 



	

}
