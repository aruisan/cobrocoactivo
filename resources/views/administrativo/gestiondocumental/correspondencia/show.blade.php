@extends('layouts.dashboard')
@section('titulo')
    Correspondencia {{ $CorrespondenciaE->name }}
@stop
@section('sidebar')
    <li><a href="{{ route('correspondencia.index') }}" class="btn btn-primary">Correspondencias</a></li>
    
    <h3 class="text-center tituloAside">Responsable</h3>

    <h4 class="text-center tituloAside">{{ $CorrespondenciaE->user->name }}</h4>
    <hr>
   
    <div class="row text-center">
        <h3 class="tituloAside">Archivo</h3>
  
        <a href="{{Storage::url($CorrespondenciaE->resource->ruta)}}" title="Ver" class="btn-lg btn-success"><i class="fa fa-file-pdf-o"></i></a>
        <hr>
 
        <h3 class="tituloAside">Editar</h3>
       
        <a href="{{ url('dashboard/correspondencia/'.$CorrespondenciaE->id.'/edit') }}" title="Editar" class="btn-lg btn-primary"><i class="fa fa-edit"></i></a>
        <hr>
    </div>



@stop
@section('content')

<div class="col-12 formularioCorrespondencia">
    <div class="row">
        <br>
        <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Correspondencia: {{ $CorrespondenciaE->name }}</h2>
        </div>
    </div>


     <div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
        <br>
        <hr>
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


    </div>
@stop