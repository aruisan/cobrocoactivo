<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Proyecto;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Eje;
use App\Model\Dependencia;

use Session;

class ProyectosController extends Controller
{
    public function create($pdd)
    {
        $pdd = Pdd::findOrFail($pdd);
            $count = 0;
            foreach($pdd->ejes as $eje){

                $count = $count + $eje->programas()->count();
            }

        return view('planeacion.pdd.data.createProyecto',compact('pdd', 'count'));
    }

    public function store(Request $request)
    {

        $id        = $request->id;
        $code        = $request->code;
        $name      = $request->nombre;

        $linea_base        = $request->linea_base;
        $indicador        = $request->indicador;
        $metaInicial      = $request->metaInicial;
        $modificacion      = $request->modificacion;
        $metaDefinitiva      = $request->metaDefinitiva;     

        $llave  	   = $request->programa_id;
        $count = count($llave);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $code[$i], $name[$i], $linea_base[$i], $indicador[$i], $metaInicial[$i], $modificacion[$i], $metaDefinitiva[$i], $llave[$i]);
                
            }else{        
                $store = new Proyecto;
                $store->name = $name[$i];
                $store->code = $code[$i];
                $store->linea_base = $linea_base[$i];
                $store->indicador = $indicador[$i];
                $store->metaInicial = $metaInicial[$i];
                $store->modificacion = $modificacion[$i];
                $store->metaDefinitiva = $metaDefinitiva[$i];
                $store->programa_id = $llave[$i];
                $store->save();
            }
        }
        Session::flash('success','Los Proyectos se han Gestionado exitosamente');
        return  back();
    }


    public function update($id, $code, $name, $linea_base, $indicador, $metaInicial, $modificacion, $metaDefinitiva, $llave)
    {
        $update = Proyecto::findOrFail($id);
        $update->name = $name;
        $update->code = $code;
        $update->linea_base = $linea_base;
        $update->indicador = $indicador;
        $update->metaInicial = $metaInicial;
        $update->modificacion = $modificacion;
        $update->metaDefinitiva = $metaDefinitiva;
        $update->programa_id = $llave;
        $update->save();
    }

    public function destroy($id)
    {
        $destroy = Proyecto::find($id);

         if($destroy->subProyectos->count() > 0){
            Session::flash('warning', 'tiene '.$destroy->subProyectos->count().' subProyectos Relacionados a este Proyecto.');
        }else{
            $destroy->delete();
            Session::flash('error','Proyecto Eliminado correctamente');
        }
    }

    public function show($id){

        $proyecto = Proyecto::find($id);
        $pdd = $proyecto->programa->eje->pdd;
        $dep = Dependencia::all();

        return view('planeacion.pdd.subproyectos.index',compact('proyecto', 'pdd','dep'));
    }
}
