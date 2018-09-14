<?php
namespace App\Traits;


Class FileTraits
{
	public function File($file, $carpeta){

		$path = public_path().'/uploads/'.$carpeta;
		$name = $file;
		$fileName = $carpeta.'_'. time().'.'.$name->getClientOriginalExtension();
        //dd($fileName);
		$move = $file->move($path, $fileName);
		return $fileName;
	}
}