<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Eje;
use Illuminate\Support\Facades\DB;

use Session;

class PdesarrolloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count= Pdd::all()->count();
        //$ejes = Eje::find(1);
        //dd($pdesarrollos->ejes);
        $tables = DB::select('SELECT ejes.name AS "ejes", programas.name AS "programas", proyectos.code AS "Numproy", proyectos.name AS "Pname", proyectos.linea_base AS "Plinea", proyectos.indicador AS "Pind", proyectos.metaInicial AS "Pini", proyectos.modificacion AS "Pmod", proyectos.metaDefinitiva AS "Pmetdef", sub_proyectos.id AS "Numsub", sub_proyectos.name AS "SPname", sub_proyectos.tipo AS "SPtipo", sub_proyectos.indicador AS "SPindi", sub_proyectos.unidad_medida AS "SPund", sub_proyectos.linea_base AS "SPlinea" FROM ejes, programas, proyectos, sub_proyectos WHERE sub_proyectos.proyecto_id = proyectos.id AND proyectos.programa_id = programas.id AND programas.eje_id = ejes.id');

        $val = 0;

        if ($count >= 1){
            $pdd = Pdd::all()->first();
            //dd($pdd);
            $val = 1;
            return view('planeacion.pdd.index',compact('val', 'pdd','tables'));
        } else{
            return view('planeacion.pdd.index', compact('val'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        if($request->hasFile('file'))
        {
            $file = new FileTraits;
            $ruta = $file->File($request->file('file'), 'Pdd');
        }else{
            $ruta = "";
        }

        $pdd = new Pdd;
        $pdd->name = $request->name;
        $pdd->ff_inicio = $request->ff_inicio;
        $pdd->ff_final = $request->ff_final;
        $pdd->user_id = 1;
        $pdd->save();
        Session::flash('success','El plan de desarrollo se ha creado exitosamente');
        return redirect('pdd/data/create/'.$pdd->id);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
