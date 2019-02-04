<?php
namespace App\Traits;
use App\Resource;
//App\Traits\ResourceTraits

Class ResourceTraits
{
	public function resource($documents, $carpeta){
		 $ruta = $documents->store($carpeta);
     	 $file = new Resource; 
     	 $file->ruta = $ruta;
	     $file->save();
	     return $file->id;
	}
}