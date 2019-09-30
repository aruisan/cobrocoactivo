<?php

namespace App\Model\Cobro;

use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    protected $table = 'predios';

    protected $fillable = [
        'ficha_catastral' ,      
        'matricula_inmobiliaria',
        'direccion_predio' ,     
        'nombre_predio' ,        
        'a_hectareas' ,          
        'a_metros' ,             
        'a_construida' ,         
        'tipo_tarifa' ,          
        'destino_economico' ,    
        'porc_tarifa' ,          
        'estrato' ,              
        'observacion' ,          
        'avaluo' ,               
        'expediente' ,           
        'v_declarado' ,          
        'impuesto_predial',      
        'interes_predial',       
        'contribucion_car' ,     
        'interes_Car' ,          
        'otros_conceptos' ,      
        'cuantia' ,              
        'inicio' ,               
        'final' ,                
        'existe' ,               
        'ubicacion' ,            
        'exento' ,               
        'semaforo' ,             
        'estado' ,               

    ];


    public function asignacion(){

    	return $this->hasOne('App\Model\Cobro\Asignacion', 'cc_id');
    }

    public function personas(){
        return $this->belongsToMany('App\Model\Persona')->withPivot('porcentaje');
    }
    

}
