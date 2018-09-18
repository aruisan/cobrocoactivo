<?php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Model\Administrativo\Registro;
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
        $rol = auth()->user()->type_id;
        $registros = Registro::orderBy('id','DESC')->paginate(5);
        return view('administrativo.registros.index',compact('registros','rol'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
 
    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cdps = Cdp::all();
        $contratos = Contractual::all();
        return view('administrativo.registros.create', compact('cdps','contratos'));
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
        $registro->valor = $request->valor;
        $registro->persona_id = $request->persona_id;
        $registro->cdp_id = $request->cdp_id;
        $registro->contrato_id = $request->contrato_id;
        $registro->secretaria_e = $request->secretaria_e;

        $registro->save();
        Session::flash('success','El registro se ha creado exitosamente');
        return redirect('/administrativo/registros');
    }
 
    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
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
        $rol = auth()->user()->type_id;
        return view('administrativo.registros.edit', compact('registro','cdps','contratos','rol'));
    }

    public function show($id)
    {
        $registro = Registro::findOrFail($id);
        $rol = auth()->user()->type_id;
        return view('administrativo.registros.show', compact('registro','rol'));
    }

    public function update(Request $request, $id)
    {

        $update = Registro::findOrFail($id);
        $update->valor = $request->valor;
        $update->objeto = $request->objeto;
        $update->persona_id = $request->persona_id;
        $update->cdp_id = $request->cdp_id;
        $update->contrato_id = $request->contrato_id;
        $update->save();

        Session::flash('success','El registro se ha actualizado exitosamente');
        return redirect('/administrativo/registros');
    }

    public function updateEstadoSec($id)
    {
        $update = Registro::findOrFail($id);
        $update->secretaria_e = 3;
        $update->save();

        Session::flash('success','El registro ha sido aprobado exitosamente');
        return redirect('/administrativo/registros');
    }
}
