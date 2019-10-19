<?php

namespace App\Http\Controllers\Cobro;
use App\Model\Cobro\Asignacion;
use App\Model\Cobro\Predio;
use App\Model\cobro\Conteo;
use App\Model\cobro\PersonaPredio;
use App\Model\Persona;
use App\Notifications\AsignacionAdministrativaPredio;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PredioController extends Controller
{
    public function prediosApi($numdc){
        $persona = Persona::where('num_dc', $numdc)->first(); 
        return response()->json($persona->predios);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::user()->type){
            if(Auth::user()->type->id == 2)
            {
                $predios = Predio::all();       
            }
            elseif(Auth::user()->type->id == 3)
            {
                // $predios = Asignacion::where('abogado_id', Auth::user()->id)->get();
                $predios = Predio::whereHas('asignacion', function ($query){
                                $query->where('abogado_id', auth()->user()->id);
                            })->get();  
            }
            elseif(Auth::user()->type->id == 4)
            {
                // $predios = Asignacion::where('secretaria_id', Auth::user()->id)->get();
                $predios = Predio::whereHas('asignacion', function ($query){
                                $query->where('secretaria_id', auth()->user()->id);
                            })->get();  
            }
        }
        else{
            $predios = Predio::all();       
        }
        return view('cobro.predios.index', compact('predios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $predio = new Predio;
        return view('cobro.predios.create', compact('predio'));
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

        $predio = new Predio;
        
        $predio->ficha_catastral = $request->ficha_catastral;
        $predio->matricula_inmobiliaria = $request->matricula_inmobiliaria;
        $predio->direccion_predio = $request->direccion_predio;
        $predio->nombre_predio = $request->nombre_predio;
        $predio->a_hectareas = $request->a_hectareas;
        $predio->a_metros = $request->a_metros;
        $predio->a_construida = $request->a_construida ;
        $predio->avaluo = $request->avaluo;
        $predio->tipo_tarifa = $request->tipo_tarifa;
        $predio->destino_economico = $request->destino_economico;
        $predio->porc_tarifa = $request->porc_tarifa;
        $predio->estrato = $request->estrato;
        $predio->observacion = $request->observacion;
        $predio->expediente = $request->expediente;
        $predio->v_declarado = $request->v_declarado;
        $predio->impuesto_predial = $request->impuesto_predial;
        $predio->interes_predial = $request->interes_predial;
        $predio->contribucion_car = $request->contribucion_car;
        $predio->interes_Car = $request->interes_Car;
        $predio->otros_conceptos = $request->otros_conceptos;
        $predio->cuantia = $request->cuantia;
        $predio->inicio = Carbon::now();
        $predio->final =  Carbon::now();
        $predio->existe = $request->existe;
        $predio->ubicacion = $request->ubicacion;
        $predio->exento = $request->exento;
        $predio->semaforo = $request->semaforo;
        $predio->estado = $request->estado;

        if($predio->save()){

            return redirect('/predios');

        }else {
            return view('predios.create', ['predios' => $predios]);
        }
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

        return view('cobro.predios.detail', ['predio' => $predio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $predio = Predio::findOrFail($id);

        return view('cobro.predios.edit', ['predio' => $predio]);
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
        $predio = Predio::findOrFail($id);

        $predio->ficha_catastral = $request->ficha_catastral;
        $predio->matricula_inmobiliaria = $request->matricula_inmobiliaria;
        $predio->direccion_predio = $request->direccion_predio;
        $predio->nombre_predio = $request->nombre_predio;
        $predio->a_hectareas = $request->a_hectareas;
        $predio->a_metros = $request->a_metros;
        $predio->a_construida = $request->a_construida ;
        $predio->avaluo = $request->avaluo;
        $predio->tipo_tarifa = $request->tipo_tarifa;
        $predio->destino_economico = $request->destino_economico;
        $predio->porc_tarifa = $request->porc_tarifa;
        $predio->estrato = $request->estrato;
        $predio->observacion = $request->observacion;
        $predio->expediente = $request->expediente;
        $predio->v_declarado = $request->v_declarado;
        $predio->impuesto_predial = $request->impuesto_predial;
        $predio->interes_predial = $request->interes_predial;
        $predio->contribucion_car = $request->contribucion_car;
        $predio->interes_Car = $request->interes_Car;
        $predio->otros_conceptos = $request->otros_conceptos;
        $predio->cuantia = $request->cuantia;
        $predio->inicio = Carbon::now();
        $predio->final =  Carbon::now();
        $predio->existe = $request->existe;
        $predio->ubicacion = $request->ubicacion;
        $predio->exento = $request->exento;
        $predio->semaforo = $request->semaforo;
        $predio->estado = $request->estado;


        if($predio->save()){

            return redirect('predios');

        }else {
        return view('predios.create', ['predio' => $predio]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $predio = Predio::findOrFail($id);
        $predio->delete();

        return redirect('predios');
    }

    

    public function predioSinAsignar()
    {
        $type = auth()->user()->type->id;
        

        if ($type == 2) {
            
            $predios = Predio::doesntHave('asignacion')->get();

        }

        if ($type == 3) {
            
            $predios = Predio::whereHas('asignacion', function ($query){
                            $query->where('abogado_id', auth()->user()->id)->where('secretaria_id', null);
                        })->get();     
        }        

        if ($type == 4) {
            
            $predios = Predio::whereHas('asignacion', function ($query){
                            $query->where('secretaria_id', auth()->user()->id);
                        })->get();     
        }

        // $predios = Predio::where('estado', 1)->first();

        // $usuariosTypeFilt = User::all()->reject(function ($user) { 
        //                      return $user->type->nombre <> 'Secretaria';
        //                     })
        //                     ->pluck('name', 'id');

        // $usuariosTypeFilt = User::whereHas('type', function ($query) use ($tipo) {
        //                     $query->where('id',$tipo-1);
        //                 })->pluck('name', 'id');
         

        $usuariosTypeFilt = User::whereHas('user_boss', function ($query) {
                            $query->where('boss_id' , auth()->user()->id);
                        })->pluck('name', 'id');

        return view('cobro.predios.unassigned', compact('predios' ,'usuariosTypeFilt'));
    }    

    public function predioAsignarAdministrativeStore(Request $request)
    {   

        $type = auth()->user()->type->id;


        $predios = $request->predios;

        if ($request->encargado) {     

            foreach ($predios as $predio) {
                
                if ($type == 2) {
                    
                    $asignacion = new Asignacion;
                    $asignacion->abogado_id = $request->encargado;
                    $asignacion->cc_id = $predio;
                    $asignacion->tabla = 'predios';
                    $asignacion->save();
                }            
                if ($type == 3) {

                    $asignacion = Asignacion::where('cc_id', $predio)->first();

                    $asignacion->secretaria_id = $request->encargado;
                    $asignacion->save();
                }

            }
            
            $encargado = User::find($request->encargado);

            // $encargado->notify(new AsignacionAdministrativaPredio($encargado));

            Session::flash('message','Se han asignados exitosamente');
            return  redirect('predios');
        }

        else {

            Session::flash('message-error','Elija un usuario encargado para asignar');
            return  redirect('admin/predios-sin-asignar');

        }
        


    }   

    public function predioAsignado(){

        $type = auth()->user()->type->id;

        // $predios = Predio::where('estado', 1)->get();

        if ($type == 2) {
            
            $predios = Predio::has('asignacion')->get();

        }

        if ($type == 3) {
            
            $predios = Predio::whereHas('asignacion', function ($query){
                $query->where('abogado_id', auth()->user()->id)->where('secretaria_id','<>', null);
            })->get();    
        }

        return view('cobro.predios.assignor', compact('predios'));
    }       

    public function asignarExpediente($id)
    {

        $predio = Predio::findOrFail($id);

        if ($predio->expediente == NULL) {
            
            $conteo = Conteo::where('tabla', 'predios')->first();

            $predio->expediente = 'PRE-'. ($conteo->valor + 1);

            if ($predio->save()) {

                $conteo->valor++;
                $conteo->save();
            }
        }

        return view('predios.edit', ['predio' => $predio]);
    }   
}
