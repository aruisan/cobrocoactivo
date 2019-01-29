<?php

namespace App\Http\Controllers\Planeacion\Pdd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Planeacion\Pdd\Pdd;
use App\Model\Planeacion\Pdd\Eje;
use App\Model\Planeacion\Pdd\SubProyecto;
use App\Model\Planeacion\Pdd\Programa;
use App\Model\Planeacion\Pdd\Proyecto;
use App\Traits\FileTraits;

use SebastianBergmann\Diff\Diff;
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
        $pdd = Pdd::all()->first();
        if (Pdd::all()->count() > 0){
            $sps = SubProyecto::all();
            $ps = Proyecto::all();
            $programas = Programa::all();
            $ejes = Eje::all();
        }
        if ($pdd == null){
            $ps = null;
            $sps = null;
            $programas = null;
        }
        return view('planeacion.pdd.index',compact('pdd','ps','sps','programas'));
        
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
        $pdd->ruta = $ruta;
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
