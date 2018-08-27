<?php

namespace App\Http\Controllers\Cobro;
use App\Model\Cobro\Documento;
use App\Model\Cobro\Predio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::user()->type->nombre == "Abogado")
        {
            $predios = Predio::whereHas('asignacion', function ($query){
                            $query->where('abogado_id', auth()->user()->id);
                        })->whereNotNull('expediente')->get();  
        }
        elseif(Auth::user()->type->nombre == "Secretaria")
        {
            $predios = Predio::whereHas('asignacion', function ($query){
                            $query->where('secretaria_id', auth()->user()->id);
                        })->whereNotNull('expediente')->get();  
        }

        return view('proceso.index', compact('predios')); 
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $predio = Predio::findOrFail($id);

        return view('proceso.show', compact('predio')); 

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

    public function uploadFile(Request $request)
    {
        
        $file = $request->file('file');

        $nombre = time().'_'.$file->getClientOriginalName();

        \Storage::disk('documentos')->put($nombre,  \File::get($file));


        $documento = new Documento;


        $documento->nombre = $nombre;

        $documento->ruta = $nombre;

        $documento->ff_documento = $request->ff_documento;

        $documento->tabla =  'predios';

        $documento->cc_id =  $request->cc_id;


        $documento->save();

        return back();
        
    }   
}
