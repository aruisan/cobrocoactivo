<?php

namespace App\Http\Controllers\Administrativo\Registro;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Model\Administrativo\Registro\Registro;
use App\Model\Administrativo\Registro\CdpsRegistro;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Administrativo\Contractuall\Contractual;
use App\Traits\FileTraits;
use Illuminate\Http\Response;

use Session;

class RegistrosController extends Controller
{
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('uploads\Registros');
    }
 
    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $registros = Registro::where('secretaria_e','!=','3')->orderBy('id','DESC')->paginate(5);
        $registrosHistorico = Registro::where('secretaria_e','3')->orderBy('id','DESC')->paginate(5);
        return view('administrativo.registros.index',compact('registros','rol', 'registrosHistorico'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
 
    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $cdps = Cdp::all()->where('jefe_e','3')->count();
        if($cdps > 0){
            $contratos = Contractual::all();
            return view('administrativo.registros.create', compact('contratos','rol'));
        }else{
            Session::flash('error','Actualmente no existen CDPs disponibles para crear registros.');
            return redirect('/administrativo/registros');
        }
    }
 
    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file'))
        {
            $file = new FileTraits;
            $ruta = $file->File($request->file('file'), 'Registros');
        }else{
            $ruta = "";
        }

        $registro = new Registro();

        $registro->objeto = $request->objeto;
        $registro->ff_expedicion = $request->fecha;
        $registro->ruta = $ruta;
        $registro->valor = "0";
        $registro->persona_id = $request->persona_id;
        $registro->contrato_id = $request->contrato_id;
        $registro->secretaria_e = $request->secretaria_e;
        $registro->ff_secretaria_e = $request->fecha;

        $registro->save();
        Session::flash('success','El registro se ha creado exitosamente');
        return redirect('/administrativo/registros');
    }

    public function destroy($id)
    {
        $destroy = Registro::find($id);

        if($destroy->ruta == ""){

            $destroy->delete();
            Session::flash('error','Registro borrado correctamente');
            return redirect('/administrativo/registros');

        }else{

            $file_path = $this->photos_path.'\ '.$destroy->ruta;
            $file_path = preg_replace('[\s+]',"", $file_path);

            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $destroy->delete();
            Session::flash('error','Registro borrado correctamente');
            return redirect('/administrativo/registros');
        }

    }

    public function edit($id)
    {
        $registro = Registro::findOrFail($id);
        $cdps = Cdp::all();
        $contratos = Contractual::all();
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        return view('administrativo.registros.edit', compact('registro','cdps','contratos','rol'));
    }

    public function show($id)
    {
        $registro = Registro::findOrFail($id);
        $roles = auth()->user()->roles;
        $cdps = Cdp::where('saldo','>',0)->get();
        foreach ($roles as $role){
            $rol= $role->id;
        }
        return view('administrativo.registros.show', compact('registro','rol','cdps'));
    }

    public function update(Request $request, $id)
    {

        $update = Registro::findOrFail($id);
        $update->objeto = $request->objeto;
        $update->persona_id = $request->persona_id;
        $update->contrato_id = $request->contrato_id;
        $update->save();

        Session::flash('success','El registro se ha actualizado exitosamente');
        return redirect('/administrativo/registros');
    }

    public function updateEstado($id,$fecha,$valor,$estado)
    {
        $update = Registro::findOrFail($id);

        $update->secretaria_e = $estado;
        $update->ff_secretaria_e = $fecha;
        $update->valor = $valor;
        $update->save();

        $cdpsRegistro = CdpsRegistro::where('registro_id', $id)->get();
        foreach ($cdpsRegistro as $data){
            $cdp = Cdp::findOrFail($data->cdp_id);
            $cdp->saldo = $cdp->saldo - $data->valor;
            $cdp->save();
        }

        Session::flash('success','Secretaria, su registro ha sido finalizado exitosamente');
        return redirect('/administrativo/registros');

    }

    public function rechazar(Request $request, $id,$rol,$estado)
    {
        if ($rol == 3){
            if ($estado == 1){
                $update = Registro::findOrFail($id);
                $update->observacion = $request->observacion;
                $update->jcontratacion_e = $estado;
                $update->secretaria_e = "0";
                $update->save();

                Session::flash('error','El registro ha sido rechazado');
                return redirect('/administrativo/registros');
            }
        }
        if ($rol == 4){
            if ($estado == 1){
                $update = Registro::findOrFail($id);
                $update->observacion = $request->observacion;
                $update->jpresupuesto_e = $estado;
                $update->jcontratacion_e = "0";
                $update->save();

                Session::flash('error','El registro ha sido rechazado');
                return redirect('/administrativo/registros');
            }
        }
    }
}
