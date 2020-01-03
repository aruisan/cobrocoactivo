@extends('layouts.dashboard')
@section('titulo')
    Crear Archivo
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/archivo') }}"><span class="hide-menu">Archivos</span></a></li> --}}
@stop
@section('content')

<div class="col-12 formularioArchivo">
        <div class="row">
            <br>
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Creación de Archivos</h2>
            </div>
        </div>



     <div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
    <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ asset('/dashboard/archivo') }}" >Volver a Archivo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">Nuevo Archivo</a>
                </li>
             
             
            </ul>
 
</div>
<div class="tab-content col-sm-12" > 
    <hr>
    {!! Form::open(array('route' => 'archivo.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <input type="hidden" name="fecha_entrada" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
    <input type="hidden" name="id_resp" value="{{ $idResp }}">
    <input type="hidden" name="type" value="Otros documentos">


    <div class="row">
       <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Nombre: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" required>
            </div>
            <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
        </div>
    

         <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Fecha del Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="fecha_doc" class="form-control" required>
            </div>
            <small class="form-text text-muted">Fecha que tiene asiganada el documento a subir</small>
        </div>
    </div>



    <div class="row">
         <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Tercero: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <select class="form-control" name="tercero">
                    @foreach($terceros as $tercero)
                        <option value="{{$tercero->id}}">{{$tercero->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Relacionar persona</small>
        </div>
    

      <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Número de Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="text" name="num_doc" class="form-control" required>
            </div>
            <small class="form-text text-muted">Número de Documento</small>
        </div>
    </div>


    <div class="row">
         <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Fecha de Vencimiento del Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="ff_vence" class="form-control" required>
            </div>
            <small class="form-text text-muted">Fecha de vencimiento del documento</small>
        </div>
  
       <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Consecutivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="text" name="consecutivo" class="form-control" required>
            </div>
            <small class="form-text text-muted">Consecutivo del Archivo</small>
        </div>
    </div>


    <div class="row">
         <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Estado actual del documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                <select class="form-control" name="estado">
                        <option value="0">Pendiente</option>
                        <option value="1">Aprobado</option>
                        <option value="2">Rechazado</option>
                        <option value="3">Archivado</option>
                </select>
            </div>
            <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el documento</small>
        </div>
  
  
        <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
            <label>Subir Archivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                <input type="file" name="fileArchivo" accept="application/pdf" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group col-xs-6 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>


</div>
@endsection