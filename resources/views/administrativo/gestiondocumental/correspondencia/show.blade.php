@extends('layouts.dashboard')
@section('titulo')
    Correspondencia {{ $CorrespondenciaE->name }}
@stop
@section('sidebar')
    {{-- <li><a href="{{ route('correspondencia.index') }}" class="btn btn-primary">Correspondencias</a></li> --}}
    
{{--     
    <hr>
   
    <div class="row text-center">
        <h3 class="tituloAside">Archivo</h3>
  
        <a href="{{Storage::url($CorrespondenciaE->resource->ruta)}}" title="Ver" class="btn-lg btn-success"><i class="fa fa-file-pdf-o"></i></a>
        <hr>
 
        <h3 class="tituloAside">Editar</h3>
       
        <a href="{{ url('dashboard/correspondencia/'.$CorrespondenciaE->id.'/edit') }}" title="Editar" class="btn-lg btn-primary"><i class="fa fa-edit"></i></a>
        <hr>
    </div>
 --}}


@stop
@section('content')

<div class="col-12 formularioCorrespondencia">
        
        <div class="breadcrumb text-center">
                <strong>
                    <h4><b>Correspondencia</b></h4>
                </strong>
            </div>


            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ route('correspondencia.index') }}" >Volver a correspondencia</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">VER</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " data-toggle="pill" href="#archivo">Archivo</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ url('dashboard/correspondencia/'.$CorrespondenciaE->id.'/edit') }}" >Editar</a>
                </li>
            </ul>
 

<div class="tab-content col-sm-12" > 
<br><br>

            <div id="ver" class="tab-pane fade in active">
        
      
                <div class="col-sm-12" style="text-align:left;"> 
                  <h3 class=" ">Responsable: {{ $CorrespondenciaE->user->name }}</h3>
                </div>

 
                <div class="row">
                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Nombre: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="name" disabled value="{{ $CorrespondenciaE->name }}">
                        </div>
                    </div>
            

                 <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Fecha de la Correspondencia: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="date" name="ff_doc" class="form-control" disabled value="{{ $CorrespondenciaE->ff_document }}">
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Consecutivo: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                            <input type="number" name="cc_id" class="form-control" disabled value="{{ $CorrespondenciaE->cc_id }}">
                        </div>
                    </div>
                

                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Fecha de Aprobación: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="date" name="ff_aprobacion" class="form-control" disabled value="{{ $CorrespondenciaE->ff_aprobacion }}">
                        </div>
                    </div>

                </div>


                @if( $CorrespondenciaE->type == "Correspondencia entrada")
                    <div class="row">
                        <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                            <label>Número de correspondencia: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                                <input type="number" name="num_doc" class="form-control" disabled value="{{ $CorrespondenciaE->number_doc }}">
                            </div>
                        </div>
                    
                        <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                            <label>Fecha de Vencimiento: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <input type="date" name="ff_vence" class="form-control" disabled value="{{ $CorrespondenciaE->ff_vence }}">
                            </div>
                        </div>
                    </div>


                @endif
                <div class="row">
                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Estado actual de la correspondencia: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                            <input type="text" name="estado" class="form-control" value="{{ $estado }}" disabled>
                        </div>
                    </div>
            
                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Fecha de Salida: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            <input type="date" name="ff_salida" class="form-control" disabled value="{{ $CorrespondenciaE->ff_salida }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Tercero: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="tercero" class="form-control" value="{{ $CorrespondenciaE->tercero->nombre }}" disabled>
                        </div>
                    </div>
        

                    <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                        <label>Respuesta: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="respuesta" disabled value="{{ $CorrespondenciaE->respuesta }}">
                        </div>
                    </div>
                </div>

             </div>

        
 
        <div id="archivo" class="tab-pane">
                    <div class="col-sm-12" style="text-align:left;"> 
                        <iframe width="100%" height="450" src="{{Storage::url($CorrespondenciaE->resource->ruta)}}"  frameborder="0"></iframe>
                    </div>
                </div>

                
  <br><br>
   </div>
           
      </div> 
@stop