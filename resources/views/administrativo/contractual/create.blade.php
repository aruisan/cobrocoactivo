@extends('layouts.dashboard')
@section('titulo')
    Creación de Contrato
@stop
@section('sidebar')


{{--                 
                    <li>
                        <a href="{{ url('/contractual') }}" class="btn btn-success">
                            <i class="fa fa-file"></i>
                            <span class="hide-menu"> Contractual</span></a>
                    </li> --}}

                
            @stop


            @section('content')
            <br>
<div class="col-xs-12 col-sm-12 col-md-12 formularioContractual">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Contractual</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
          
                <li class="nav-item active">
                    <a class="nav-link "  href="{{ url('/contractual') }}"> Volver a Contractual</a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link regresar"  href="#" >Nuevo </a>
                </li>
             
            </ul>
            
    <div class="tab-content col-sm-12" >

                <form id="form-create"  method="POST" action="{{ route('contractual.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <br><br>
    <div class="row inputCenter" >
                  
                  <div class="row">
                   <label>Responsable:</label> 
                   </div>
                  <div class="row">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="responsable">
                    </div>

                    <small class="form-text text-muted">Nombre completo del responsable del contrato</small>

                    <br>

                    <label>Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                        <input type="number" class="form-control" name="valor" >

                    </div>


                    <small class="form-text text-muted">Valor del contrato</small>
                    <br>

                    <label>Asunto: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="asunto"  >
                    </div>
                    <small class="form-text text-muted">Asunto del contrato</small>

           
                    <div class="row">
                     
 <br> <br>
                            
                            <div class="form-group col-lg-5">
                            <button class="btn btn-primary btn-block" type="submit">Guardar</button>  
                         </div>
                        
                        <div class="form-group col-lg-2">
                            </div>


                        {{-- <div class="form-group col-lg-5">
                            <button class="btn btn-danger ocultar btn-block" id="contractual">Cancelar</button>
                            </div> --}}
                       

                    </div>

</div>
                </form>
            </div>
         </div>
         </div>
      </div>
            @stop