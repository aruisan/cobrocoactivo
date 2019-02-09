<?php
namespace App\Traits;


Class FileTraits
{
	public function File($file, $carpeta){

        $path = public_path().'/uploads/'.$carpeta;
        $name = $file;
        $fileName = $carpeta.'_'. time().'.'.$name->getClientOriginalExtension();
        $move = $file->move($path, $fileName);
        return $fileName;

	}

	public function Img($file, $carpeta, $name){
        $path = public_path().'/img/'.$carpeta;
        $ext = $file;
        $fileName = $name.'.'.$ext->getClientOriginalExtension();
        $move = $file->move($path, $fileName);
        return $move;
    }
}