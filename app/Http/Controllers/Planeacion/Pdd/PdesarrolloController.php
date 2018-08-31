<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Eje;
use App\Model\Planeacion\Pdd\SubProyecto;
use App\Model\Planeacion\Pdd\Programa;
use App\Model\Planeacion\Pdd\Proyecto;
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
        //$ejes = Eje::find(1);
        //dd($pdesarrollos->ejes);

        if (Pdd::all()->count() > 0){
            /*$ejes= Eje::all();
            foreach ($ejes as $eje){
                foreach ($eje->programas as $programa) {
                    $numPR = count($programa->proyectos);
                    foreach ($programa->proyectos as $proyecto) {
                        $numSP = count($proyecto->Subproyectos);
                    }
                    $listProg[] = collect(['id' => $programa->id, 'name' => $programa->name, 'eje_id' => $programa->eje_id, 'span' => $numPR]);
                }
                $listEjes[] = collect(['id' => $eje->id, 'name' => $eje->name, 'pdd_id' => $eje->pdd_id, 'span' => $numSP]);
            }*/
            $sps = SubProyecto::all();
            $ps = Proyecto::all();
            $programas = Programa::all();
            foreach ($sps as $sp){
                $listSP[] = collect(['id' => $sp->id, 'name' => $sp->name, 'proy_id' => $sp->proyecto_id, 'span' => '']);
            }
            foreach ($ps as $p){
                $numSP = count($p->subProyectos);
                $listProy[] = collect(['id' => $p->id, 'name' => $p->name, 'prog_id' => $p->programa_id, 'span' => $numSP]);
            }
            foreach ($programas as  $programa){
                foreach ($listProy as $list){
                    //dd($programa, $list);
                    if ($programa->id == $list['prog_id']){
                        $listProg = null;
                        dd($listProg, $list);
                        if (count($listProg) > 0){
                            foreach ($listProg as $prog){
                                if ($prog['id'] == $programa->id){
                                    $span = $prog['span'] + $list['span'];
                                    //dd($span);
                                }
                            }
                        }else{
                            $listProg[] = collect(['id' => $programa->id, 'name' => $programa->name, 'eje_id' => $programa->eje_id, 'span' => $list['span']]);
                        }
                    }
                }
            }
            //dd($listProg);
            $tables = DB::select('SELECT ejes.name AS "ejes", programas.name AS "programas", proyectos.code AS "Numproy", proyectos.name AS "Pname", proyectos.linea_base AS "Plinea", proyectos.indicador AS "Pind", proyectos.metaInicial AS "Pini", proyectos.modificacion AS "Pmod", proyectos.metaDefinitiva AS "Pmetdef", sub_proyectos.id AS "Numsub", sub_proyectos.name AS "SPname", sub_proyectos.tipo AS "SPtipo", sub_proyectos.indicador AS "SPindi", sub_proyectos.unidad_medida AS "SPund", sub_proyectos.linea_base AS "SPlinea" FROM ejes, programas, proyectos, sub_proyectos WHERE sub_proyectos.proyecto_id = proyectos.id AND proyectos.programa_id = programas.id AND programas.eje_id = ejes.id');
        }else{
            $tables = 0;
        }
        $pdd = Pdd::all()->first();
        return view('planeacion.pdd.index',compact('pdd','tables', 'listEjes','listProg'));
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
