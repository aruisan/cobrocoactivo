<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
	
	protected $table = 'documentos';

	protected $fillable = ['nombre', 'ruta', 'ff_documento', 'tabla' , 'cc_id'];

}
