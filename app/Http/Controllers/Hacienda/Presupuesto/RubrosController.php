<?php

namespace App\Http\Controllers\Hacienda\Presupuesto;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Model\Hacienda\Presupuesto\Rubro;
use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Hacienda\Presupuesto\Font;
use App\Model\Planeacion\Pdd\SubProyecto;
use App\Model\Dependencia;
use App\Model\Hacienda\Presupuesto\Vigencia;
use App\Model\Hacienda\Presupuesto\Level;
use App\Model\Hacienda\Presupuesto\Register;
use Illuminate\Support\Facades\DB;

use Session;

class RubrosController extends Controller
{
    public function create($vigencia_id)
    {
      $vigencia = Vigencia::findOrFail($vigencia_id);
      $fonts = Font::where('vigencia_id', $vigencia_id)->get();
      $niveles = Level::where('vigencia_id', $vigencia_id)->get();
      $subProy = SubProyecto::all();
      $ultimoLevel = Level::where('vigencia_id', $vigencia_id)->get()->last();
      $registers = Register::where('level_id', $ultimoLevel->id)->get();

       foreach ($registers as $register){
                $register_id = $register->code_padre->registers->id;
                $code = $register->code_padre->registers->code.$register->code;
                $ultimo = $register->code_padre->registers->level->level;
                  while($ultimo > 1){
                        $registro = Register::findOrFail($register_id);
                        $register_id = $registro->code_padre->registers->id;
                        $code = $registro->code_padre->registers->code.$code;
                        
                        $ultimo =  $registro->code_padre->registers->level->level;
                   
                    }
                    $codigos[] = collect(['id' => $register->id , 'codigo' => $code]);
            }


      $levels = Rubro::where('vigencia_id', $vigencia_id)->count();
        if($levels == 0){
           $fila = $vigencia->ultimo;
        }else if($levels >= $vigencia->ultimo){
            $fila = 0;
        }else if( $vigencia->ultimo > $levels){
            $fila = $vigencia->ultimo - $levels;
        }

      return view('hacienda.presupuesto.vigencia.createRubros', compact('vigencia', 'fonts', 'subProy', 'fila', 'niveles', 'registers', 'codigos','vigencia_id'));
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
        $id         = $request->rubro_id;
        $name       = $request->nombre;
        $subProy    = $request->subproyecto_id;
        $code       = $request->code;
        $register   = $request->register_id;
        $vigencia   = $request->vigencia_id;
        $count = count($register);

        for($i = 0; $i < $count; $i++){

            if($id[$i]){
                $this->update($id[$i], $name[$i], $code[$i], $register[$i], $subProy[$i]);
            }else{          
                $rubro = new Rubro();
                $rubro->name = $name[$i];
                $rubro->cod = $code[$i];
                $rubro->register_id = $register[$i];
                $rubro->subproyecto_id = $subProy[$i];
                $rubro->vigencia_id = $vigencia;
                $rubro->save();
            }
        }

       return  back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $rubro = Rubro::findOrFail($id);
        $rubros = Rubro::where('id', '!=', $id)->get();
        $fuentesR = $rubro->Fontsrubro;
        $fuentesAll = Font::all();
        $valor = $fuentesR->sum('valor');
        $valorDisp = $fuentesR->sum('valor_disp');
        return view('hacienda.presupuesto.rubro.show', compact('rubro','fuentesR','valor','valorDisp','rol','rubros','fuentesAll'));
        
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
    public function update($id, $name, $code, $register, $subproyecto_id)
    {
        //dd($name);
        $rubro = Rubro::findOrFail($id);
        $rubro->name = $name;
        $rubro->cod = $code;
        $rubro->register_id = $register;
        $rubro->subproyecto_id = $subproyecto_id;
        $rubro->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Rubro::find($id);
        $proyecto->delete();
    }

    public function index()
    {
        $dependencia = auth()->user()->dependencia_id;
        $usuario = auth()->id();
        $rubros = Rubro::all();

        foreach ($rubros as $rubro){
            if ($dependencia == $rubro->subProyecto->dependencia->id){
                $datas[]= collect(['idRubro'=>$rubro->id,'codRubro'=> $rubro->cod,'name' => $rubro->name, 'dep' => $rubro->subProyecto->dependencia->name, 'subP' => $rubro->subProyecto->name, 'valor' => $rubro->fontsRubro->sum('valor')]);
            }
        }

        return view('administrativo.contractual.rubrosAsignados', compact('datas'));
    }

    public function movimiento(Request $request, $m, $id)
    {
        if ($m == 1){

            $fuenteR_id = $request->fuenteR_id;
            $valor_Red  = $request->valorRed;
            $count = count($fuenteR_id);
            $fuente_id_Add = $request->fuente_id;

            for($i = 0; $i < $count; $i++){

                $Frubro = FontsRubro::findOrFail($fuenteR_id[$i]);
                $Frubro->reduccion = $Frubro->reduccion + $valor_Red[$i];
                $Frubro->valor_disp = $Frubro->valor_disp - $valor_Red[$i];
                $Frubro->save();

                $FAdd = FontsRubro::where('rubro_id', $id)->get();
                if ($FAdd[$i]->font_id == $fuente_id_Add[$i] ){
                    $rubroEdit = FontsRubro::findOrFail($FAdd[$i]->id);
                    $rubroEdit->adicion = $rubroEdit->adicion + $valor_Red[$i];
                    $rubroEdit->valor_disp = $rubroEdit->valor_disp + $valor_Red[$i];
                    $rubroEdit->save();
                }
            }

            Session::flash('success','La adición se realizo correctamente');
            return redirect('/presupuesto/rubro/',$id);

        } elseif ($m == 2){
            dd($request, $m, $id);
        }
    }
}
