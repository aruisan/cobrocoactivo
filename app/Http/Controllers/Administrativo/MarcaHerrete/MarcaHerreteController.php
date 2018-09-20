<?php

namespace App\Http\Controllers\Administrativo\MarcaHerrete;

use App\Http\Controllers\Controller;
use App\Model\Administrativo\MarcaHerrete\Marcaherrete;
use App\Model\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaHerreteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $registros = Marcaherrete::orderBy('id','DESC')->paginate(5);
        return view('administrativo.marcaherrete.index',compact('registros'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrativo.marcaherrete.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $file = $request->file('file');
        $nombre = time().'_'.$file->getClientOriginalName();
        Storage::disk('documentos')->put($nombre,  \File::get($file));


        $store =  new Marcaherrete;
        $store->ff_expedicion = $request->ff_exp;    
        $store->ff_vencimiento = $request->ff_venc;    
        $store->ruta = $nombre;    
        
        $persona= Persona::where('num_dc', $request->persona_id)->first(); 

        $store->persona_id = $persona->id;  
        $store->save();
        return redirect()->route('marcas-herretes.index')
                        ->with('success','Marca Herrete Registrado Exitosamente');
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
        $data = Marcaherrete::find($id);

        $persona = Persona::find($data->persona_id);

        return view('administrativo.marcaherrete.edit', compact('data', 'persona'));
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

        $update = Marcaherrete::find($id);

        $update->ff_expedicion = $request->ff_exp;    
        $update->ff_vencimiento = $request->ff_venc;   

        if ($request->file('file')) {
            if (Storage::disk('documentos')->exists($update->ruta)) {

                //se borra la imagen anterior    
                Storage::disk('documentos')->delete($update->ruta);

                //nueva imagen
                $file = $request->file('file');
                $nombre = time().'_'.$file->getClientOriginalName();
                Storage::disk('documentos')->put($nombre,  \File::get($file));

                $update->ruta = $nombre;    
             }
        } 
        
        $persona= Persona::where('num_dc', $request->persona_id)->first(); 

        $update->persona_id = $persona->id;  
        $update->save();

        return redirect()->route('marcas-herretes.index')
                        ->with('success','Marca Herrete Actualizada Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marcaherrete = MarcaHerrete::find($id);

        if (Storage::disk('documentos')->exists($marcaherrete->ruta)) {

            Storage::disk('documentos')->delete($marcaherrete->ruta);
        }
        
        $marcaherrete->delete();

        return redirect()->route('marcas-herretes.index')
                        ->with('success','Marca Herrete Eliminada Exitosamente');
    }
}
