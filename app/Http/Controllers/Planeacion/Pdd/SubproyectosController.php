<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\SubProyecto;
use App\Model\Planeacion\Pdd\Periodo;
use App\Model\Dependencia;

use Session;

class SubproyectosController extends Controller
{
    
    public function create($pdd)
    {
        $pdd = Pdd::find($pdd);

        return view('planeacion.pdd.subproyectos.create',compact('pdd'));
    }

    public function store(Request $request)
    {

        $store = new SubProyecto;
        $store->name = $request->name;
        $store->linea_base = $request->linea_base;
        $store->indicador = $request->indicador;
        $store->tipo = $request->tipo;
        $store->unidad_medida = $request->unidad_medida;
        $store->proyecto_id = $request->proyecto_id;
        $store->dependencia_id = $request->dependencia_id;
        $store->save();

        $mi       = $request->mi;
        $mod      = $request->mod;
        $md       = $request->md;
        $vi       = $request->vi;
        $pd       = $request->pd;
        $llave    = $store->id;

        $count = count($pd);

        for($i = 0; $i < $count; $i++){

                $this->storePeriodo($pd[$i], $mi[$i], $mod[$i], $md[$i], $vi[$i], $llave);
                
        }
        Session::flash('success','Los SubProyectos se han creado exitosamente');
        return  redirect('/pdd/proyecto/'.$request->proyecto_id);
    }

    public function storePeriodo($pd, $mi, $mod, $md, $vi, $llave){
        $store = new Periodo;
        $store->periodo = $pd;
        $store->metaInicial = $mi;
        $store->modificacion = $mod;
        $store->metaDefinitiva = $md;
        $store->ValorInicial = $vi;
        $store->subProyecto_id = $llave;
        $store->save();

    }

    public function edit($id){

        $sub = SubProyecto::findOrFail($id);
        $dep = Dependencia::all();
        $pdd = $sub->proyecto->programa->eje->pdd;
        return view('planeacion.pdd.subproyectos.edit', compact('sub', 'pdd','dep'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $store = SubProyecto::findOrFail($id);
        $store->name = $request->name;
        $store->linea_base = $request->linea_base;
        $store->indicador = $request->indicador;
        $store->tipo = $request->tipo;
        $store->unidad_medida = $request->unidad_medida;
        $store->dependencia_id = $request->dependencia_id;
        $store->save();

        $mi       = $request->mi;
        $mod      = $request->mod;
        $md       = $request->md;
        $vi       = $request->vi;
        $pd       = $request->pd;
        $llave    = $store->id;

        $count = count($pd);

        for($i = 0; $i < $count; $i++){
                $this->updatePeriodo($pd[$i], $mi[$i], $mod[$i], $md[$i], $vi[$i], $llave);
        }
        Session::flash('success','Los SubProyectos se han Editado exitosamente');
        return  redirect('/pdd/proyecto/'.$store->proyecto_id);
    }

    public function updatePeriodo($pd, $mi, $mod, $md, $vi, $llave){
        $store = Periodo::findOrFail($pd);
        //$store->periodo = $pd;
        $store->metaInicial = $mi;
        $store->modificacion = $mod;
        $store->metaDefinitiva = $md;
        $store->ValorInicial = $vi;
        $store->subProyecto_id = $llave;
        //dd($store);
        $store->save();

    }

    public function destroy($id)
    {
        $destroy = SubProyecto::find($id);
        $periodos = Periodo::where('subproyecto_id', $id)->delete();
        $destroy->delete();
        Session::flash('error','SubProyecto Eliminado correctamente');
    }

    
}
