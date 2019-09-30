<?php

namespace App\Http\Controllers\Cobro;
use App\Model\Cobro\Predio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    

    public function import(Request $request)
    {

	    // Get csv file, save and read
	    $file = $request->file('archivo');
	    $nombre = time().'_'.$file->getClientOriginalName();
	    \Storage::disk('csv')->put($nombre,  \File::get($file));

	    Excel::load('csv/'.$nombre, function($reader) {

	        foreach ($reader->get() as $predio) {

	          # Create a new predio

	            Predio::create([

				    'ficha_catastral' => 	   $predio->ficha_catastral,
				  	'matricula_inmobiliaria'=> $predio->matricula_inmobiliaria,
				    'direccion_predio' =>  	   $predio->direccion_predio,
				    'nombre_predio' =>  	   $predio->nombre_predio,
				    'a_hectareas' => 		   $predio->a_hectareas,
				    'a_metros' =>  			   $predio->a_metros,
				    'a_construida' =>  		   $predio->a_construida,
				    'tipo_tarifa' =>  		   $predio->tipo_tarifa,
				    'destino_economico' =>     $predio->destino_economico,
				    'porc_tarifa' =>  		   $predio->porc_tarifa,
				    'estrato' =>  			   $predio->estrato,
				    'observacion' =>  		   $predio->observacion,
				    'avaluo' =>  			   $predio->avaluo,
				    'expediente' =>  		   $predio->expediente,
				    'v_declarado' =>  		   $predio->v_declarado,
				    'impuesto_predial'=>  	   $predio->impuesto_predial,
				    'interes_predial'=>  	   $predio->interes_predial,
				    'contribucion_car' =>  	   $predio->contribucion_car,
				    'interes_Car' =>  		   $predio->interes_car,
				    'otros_conceptos' =>  	   $predio->otros_conceptos,
				    'cuantia' =>  			   $predio->cuantia,
				    'inicio' =>  			   $predio->inicio,
				    'final' =>  			   $predio->final,
				    'existe' =>  			   $predio->existe,
				    'ubicacion' =>  		   $predio->ubicacion,
				    'exento' =>  			   $predio->exento,
				    'semaforo' =>  			   $predio->semaforo,
				    'estado' =>   			   $predio->estado

	         	]);

	        }
	    });
       
       	# Redirect to succesfully upload

        Session::flash('success','Se han importado los predios exictosamente');
        return redirect('predios');
    }
}
