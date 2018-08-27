<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Eje;

use Session;

class EjesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pdd)
    {
        $eje = Eje::find(1);
        //dd($eje->programas);
        $pdd = Pdd::findOrFail($pdd);
        return view('Planeacion.Pdd.data.createDataPdd',compact('pdd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id        = $request->id;
        $name      = $request->nombre;
        $pdd  = $request->pdd_id;
        $count = count($name);
        //dd($pdd);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i]);
                
            }else{        
                $store = new Eje;
                $store->name = $name[$i];
                $store->pdd_id = $pdd;
                $store->save();
            }
        }
        Session::flash('success','Los Ejes se han creado exitosamente');
        return  back();
    }

    
    public function update($id, $name)
    {
        $update = Eje::findOrFail($id);
        $update->name = $name;
        $update->save();
    }

    public function destroy($id)
    {
        $destroy = Eje::find($id);

         if($destroy->programas->count() > 0){
            Session::flash('warning', 'tiene '.$destroy->programas->count().' Programas Relacionados a este eje.');
        }else{
            $destroy->delete();
            Session::flash('error','Eje Eliminado correctamente');
        }
    }
}
