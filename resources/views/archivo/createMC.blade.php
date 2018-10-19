@extends('layouts.dashboard')
@section('titulo')
    Crear Archivo
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/archivo') }}"><span class="hide-menu">Archivos</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Archivos</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    {!! Form::open(array('route' => 'registros.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <input type="hidden" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
    <input type="hidden" name="secretaria_e" value="0">
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Nombre: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="number" class="form-control" name="valor" required>
            </div>
            <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Tercero: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" name="persona_id" class="form-control" data-toggle="modal" data-target="#participante">
            </div>
            <small class="form-text text-muted">Relacionar persona</small>
        </div>
    </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Número de Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="num_doc" class="form-control">
                </div>
                <small class="form-text text-muted">Número de Documento si lo tiene</small>
            </div>
        </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Subir Archivo: </label>
            <div class="input-group">
                <input type="file" name="file" accept="application/pdf" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection