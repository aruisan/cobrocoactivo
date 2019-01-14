<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Programa;
use Session;

class ProgramasController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $id        = $request->id;
        $name      = $request->nombre;
        $eje  	   = $request->eje_id;
        $count = count($eje);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $eje[$i]);
                
            }else{        
                $store = new Programa;
                $store->name = $name[$i];
                $store->eje_id = $eje[$i];
                $store->save();
            }
        }
        Session::flash('success','Los Programas se han Gestionado exitosamente');
        return  back();
    }


    public function update($id, $name, $eje)
    {
        $update = Programa::findOrFail($id);
        $update->name = $name;
        $update->eje_id = $eje;
        $update->save();
    }

    public function destroy($id)
    {
        $destroy = Programa::find($id);

         if($destroy->proyectos->count() > 0){
            Session::flash('warning', 'tiene '.$destroy->proyectos->count().' Proyectos Relacionados a este Programa.');
        }else{
            $destroy->delete();
            Session::flash('error','Programa Eliminado correctamente');
        }
    }
}
