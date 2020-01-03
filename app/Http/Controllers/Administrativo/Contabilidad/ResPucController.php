<?php

namespace App\Http\Controllers\Administrativo\Contabilidad;

use App\Model\Administrativo\Contabilidad\gPuc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class ResPucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        $child =  gPuc::with('childrens')->get();
        $parent = gPuc::with('parents')->get();

       $codigosi = gPuc::where('type','=','1')->where('enable','=', 1)->withCount('childrens')->get();
        $codigosg = gPuc::where('type','=','2')->where('enable','=', 1)->withCount('childrens')->get();
       

           return view('administrativo.contabilidad.puc.pucIndex', compact('codigosi','codigosg'));

           
        
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('administrativo.contabilidad.puc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $puc = new Puc();
        // $puc->vigencia = $request->vigencia;
        // $puc->levels = $request->niveles;
        // $puc->save();

        // return  redirect('administrativo/contabilidad/puc/level/create/'.$puc->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function show(Puc $puc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function edit(Puc $puc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puc $puc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puc  $puc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puc $puc)
    {
        //
    }
}
