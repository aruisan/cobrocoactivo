@extends('layouts.dashboard')
@section('titulo')
    Agregar Resoluciones
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li>
@stop
@section('content')



<div class="col-12 formularioResolucion">
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Agregar Resolución</h2>
    </div>
</div>
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
    <br>
    <hr>
    {!! Form::open(array('route' => 'resoluciones.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
     <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Nombre: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" required>
            </div>
            <small class="form-text text-muted">Nombre de la resolución</small>
        </div>


       <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Fecha del Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="ff_doc" class="form-control" required>
            </div>
            <small class="form-text text-muted">Fecha del Documento en el que se encuentra la resolución</small>
        </div>
    </div>


    <div class="row">
       <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Consecutivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="number" name="cc_id" class="form-control" required>
            </div>
            <small class="form-text text-muted">Consecutivo asignado a la resolución</small>
        </div>
  

         <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Comisión: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <select class="form-control" name="comision_id">
                    @foreach($Comisiones as $comision)
                        <option value="{{$comision->id}}">{{$comision->id}} - {{$comision->name}}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Comisión asignada a la resolución</small>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <label>Subir Archivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                <input type="file" name="fileResolucion" accept="application/pdf" class="form-control" required>
            </div>
            <small class="form-text text-muted">Archivo correspondiente a la resolución</small>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Agregar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection