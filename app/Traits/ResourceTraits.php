<?php
namespace App\Traits;
use App\Resource;


Class ResourceTraits
{
	public function resource($request, $carpeta){

		 $ruta = $request->file('file')->store($carpeta);
     	 $file = new Resource; 
     	 $file->ruta = $ruta;
	     return $file->save();
	}
}