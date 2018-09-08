<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ModuloInicial;
use App\File;

class SubirArchivoController extends Controller
{
    public function store(Request $request)
    {
       $path = public_path().'/uploads/modulos';
       $file = $request->file('file');
        //$path = public_path().'/uploads/';
       $nombre = 'siex-girardot'. time().'.'.$file->getClientOriginalName();
       //$foto = \Storage::disk('local')->put($nombre,  \File::get($file));
       $upload = \Request::file('file')->move($path, $nombre);
       
       if($file == true)
       {
        $ingresar = new File;
        $ingresar->nombre= $request->nombre;
        $ingresar->ruta  = $nombre;
        $ingresar->ff_cargue = $request->fecha;
        $ingresar->proceso_id = $request->id;
        $ingresar->save();
        return redirect()->route('subirArchivo.show', $request->id)
                ->with('success','El archivo fue subido correctamente');
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
        $archivos = File::where('proceso_id', $id)->get();
        $modulo = ModuloInicial::find($id);
        return view('subirFile.index')->with('modulo',$modulo)->with('archivos',$archivos);
    }
}
