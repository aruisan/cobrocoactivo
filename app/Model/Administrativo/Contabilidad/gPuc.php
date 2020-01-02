<?php

namespace App\Model\Administrativo\Contabilidad;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class gPuc extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // protected $guarded = [];
    //     protected $fillable = [
    //         'code',
    //         'name',
    //         'parent',
    //         'order',
    //         'enable',
    //         'type',
    //     ];


        var $mom, $kids;

        function __construct() { 
            if($this->dependency_id<>0) {
                $this->parent->with('parent');  
            }
        }
        public function childrens() {
            $children = $this->hasMany($this, 'parent');
            
            foreach($children as $child) {
                $child->mom = $this;
            }
            return  $children;
        }

        public function childrensCount() {
            return $this->hasMany($this, 'parent');
            }

           
        

        public function parents() {
            $mother = $this->belongsTo($this, 'parent');
            if(isset($mother->kids)) {
                $mother->kids->merge($mother);
            }
            return $mother;
        }
        // public function hijos()
        // {
        //     return $this->hasMany($this, 'parent')->withCount('childrens');
        // }

        // function childrens(){
        //     return $this->hasMany($this, 'parent');
        // }

        // public function parents()
        // {
        //     return $this->hasMany($this, 'parent')->withCount('childrens');
        // }
}
