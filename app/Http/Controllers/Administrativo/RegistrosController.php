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
        $this->photos_path = public_path('/upload/registros');
    }
 
    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $registros = Registro::orderBy('id','DESC')->paginate(5);
        return view('administrativo.registros.index',compact('registros'))
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
        if(isset($request->file))
        {
            $file = new FileTraits;
            $ruta = $file->File($request->file, 'registros');
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        $destroy = Registro::find($id);

 
        $file_path = $this->photos_path . '/' . $request->ruta;
        //dd($file_path);
        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (file_exists($resized_file)) {
            unlink($resized_file);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
        Session::flash('error','Archivo borrado correctamente');
    }
}
