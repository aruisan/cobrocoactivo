<?php

namespace App\Http\Controllers;

use App\Model\Persona;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
     function __construct()
    {
         $this->middleware('permission:terceros-list');
         $this->middleware('permission:terceros-create', ['only' => ['create','store']]);
         $this->middleware('permission:terceros-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:terceros-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $personas = Persona::all();

        return view('personas.index', compact('personas')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $persona = new Persona;

        return view('personas.create', compact('persona')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $persona = Persona::create($request->all());
        return redirect()->route('personas.index');
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
        $persona = Persona::findOrFail($id);

        return view('personas.edit', ['persona' => $persona]);
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
        $persona = Persona::find($id)->update($request->all());
        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return back();
    }

    public function personaFind($identificador){

        $persona = Persona::where('num_dc',$identificador)->first();
        
        return response()->json($persona);
    }

    public function PersonafindCreate(Request $request){
        $persona = Persona::where('num_dc',$request->num_dc)->first();

        if($persona){
            return $persona;
        }

        $persona = new Persona;

        $persona->nombre = $request->nombre;
        $persona->num_dc = $request->num_dc;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;
        $persona->tipo = $request->tipo;
        $persona->telefono = $request->telefono;

        $persona->save();


        return $persona;
        
    }
}
  