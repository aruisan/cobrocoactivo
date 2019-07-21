<?php

namespace App\Http\Controllers\Administrativo\Registro;

use App\Model\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Model\Administrativo\Registro\Registro;
use App\Model\Administrativo\Registro\CdpsRegistro;
use App\Model\Administrativo\Registro\CdpsRegistroValor;
use App\Model\Administrativo\Cdp\Cdp;
use App\Model\Administrativo\Contractuall\Contractual;
use App\Traits\FileTraits;
use Illuminate\Http\Response;

use Session;
use App\Model\Hacienda\Presupuesto\Vigencia;
use Carbon\Carbon;

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
        $registrosHistorico = Registro::where('secretaria_e','3')->orderBy('id','DESC')->get();
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
        $personas = Persona::all();
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        $cdp = Cdp::all()->where('jefe_e','3')->count();
        if($cdp > 0){
            $cdps = Cdp::all()->where('jefe_e','3')->where('saldo','>','0');
            return view('administrativo.registros.create', compact('rol','personas','cdps'));
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
        $registro->saldo = "0";
        $registro->iva = "0";
        $registro->persona_id = $request->persona_id;
        if ($request->tipo_doc_text == null){
            $registro->tipo_doc = $request->tipo_doc;
        } elseif($request->tipo_doc == "Otro" and $request->tipo_doc_text != null) {
            $registro->tipo_doc = $request->tipo_doc_text;
        } else {
            $registro->tipo_doc = $request->tipo_doc;
        }
        $registro->num_doc = $request->num_tipo_doc;
        $registro->ff_doc = $request->fecha_tipo_doc;
        $registro->secretaria_e = $request->secretaria_e;
        $registro->ff_secretaria_e = $request->fecha;
        $registro->save();

        $fuenteRubroId = $request->fuente_id;
        $rubroId = $request->rubro_id;
        $cdpId = $request->cdp_id_s;
        $valorRubro = $request->valorFuenteUsar;
        $rubrosCdpId = $request->rubros_cdp_id;
        $rubrosCdpValorId = $request->rubros_cdp_valor_id;
        $registro_id = $registro->id;
        $cdps = $request->cdp_id;

        if ($cdps != null) {
            $count = count($cdps);

            for($i = 0; $i < $count; $i++){

                $cdpsRegistro = new CdpsRegistro();
                $cdpsRegistro->registro_id = $registro_id;
                $cdpsRegistro->cdp_id = $cdps[$i];
                $cdpsRegistro->valor = 0;
                $cdpsRegistro->save();
            }
        }

        if ($valorRubro != null){

            $countV = count($valorRubro);

            for($i = 0; $i < $countV; $i++){

                if ($rubrosCdpValorId[$i]){
                    $this->updateV($rubrosCdpValorId[$i], $valorRubro[$i]);
                }else{
                    $cdpsRegistroValor = new CdpsRegistroValor();
                    $cdpsRegistroValor->valor = $valorRubro[$i];
                    $cdpsRegistroValor->valor_disp = $valorRubro[$i];
                    $cdpsRegistroValor->fontsRubro_id = $fuenteRubroId[$i];
                    $cdpsRegistroValor->registro_id = $registro_id;
                    $cdpsRegistroValor->cdp_id = $cdpId[$i];
                    $cdpsRegistroValor->rubro_id = $rubroId[$i];
                    $cdpsRegistroValor->cdps_registro_id = $rubrosCdpId[$i];
                    $cdpsRegistroValor->save();
                }
            }

        }

        Session::flash('success','El registro se ha creado exitosamente');
        return redirect('/administrativo/registros/'.$registro->id);
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
        $personas = Persona::all();
        $registro = Registro::findOrFail($id);
        $cdps = Cdp::all();
        $contratos = Contractual::all();
        $roles = auth()->user()->roles;
        foreach ($roles as $role){
            $rol= $role->id;
        }
        return view('administrativo.registros.edit', compact('registro','cdps','contratos','rol','personas'));
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
        $update->iva = $request->iva;
        $update->persona_id = $request->persona_id;
        if ($request->tipo_doc_text == null){
            $update->tipo_doc = $request->tipo_doc;
        } elseif($request->tipo_doc == "Otro" and $request->tipo_doc_text != null) {
            $update->tipo_doc = $request->tipo_doc_text;
        } else {
            $update->tipo_doc = $request->tipo_doc;
        }
        $update->save();

        Session::flash('success','El registro se ha actualizado exitosamente');
        return redirect('/administrativo/registros');
    }

    public function updateEstado($id,$fecha,$valor,$estado,$valTot)
    {
        $update = Registro::findOrFail($id);

        $update->secretaria_e = $estado;
        $update->ff_secretaria_e = $fecha;
        $update->valor = $valor;
        $update->saldo = $valTot;
        $update->val_total = $valTot;
        $update->save();

        $cdpsRegistroValor = CdpsRegistroValor::where('registro_id', $id)->get();
        foreach ($cdpsRegistroValor as $value){
            $cdp = Cdp::findOrFail($value->cdp_id);
            $cdp->saldo = $cdp->saldo - $value->valor;
            $cdp->save();
            foreach ($cdp->rubrosCdp as $RCDP){
                $RCDP->rubrosCdpValor->first()->valor_disp = $RCDP->rubrosCdpValor->first()->valor_disp - $value->valor;
                $RCDP->rubrosCdpValor->first()->save();
            }
        }

        Session::flash('success','Secretaria, su registro ha sido finalizado exitosamente');
        return redirect('/administrativo/registros/'.$id);

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

    public function pdf($id){
        $registro = Registro::findOrFail($id);

         $vigens = Vigencia::where('id', '>',0)->get();
        foreach ($vigens as $vigen) {
            $V = $vigen->id;
        }
        $vigencia_id = $V;
        $vigencia = Vigencia::find($vigencia_id);

    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $fecha = Carbon::createFromTimeString($registro->created_at);

        $pdf = \PDF::loadView('administrativo.registros.pdf', compact('registro', 'vigencia', 'dias', 'meses', 'fecha'))->setOptions(['images' => true,'isRemoteEnabled' => true]);
            return $pdf->stream();
    }
}

