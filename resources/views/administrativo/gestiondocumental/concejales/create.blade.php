@extends('layouts.dashboard')
@section('titulo')
    Crear Concejal
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/concejales') }}"><span class="hide-menu">CONCEJALES</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Concejal</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    {!! Form::open(array('route' => 'concejales.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Usuario: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <select class="form-control" name="dato_id">
                    @foreach($Usuarios as $usuario)
                        <option value="{{$usuario['id']}}">{{$usuario['name']}}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Comisión asignada al acuerdo</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Partido: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                <input type="text" name="partido" class="form-control" required>
            </div>
            <small class="form-text text-muted">Partido del concejal</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Periodo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="text" name="periodo" class="form-control" required>
            </div>
            <small class="form-text text-muted">Periodo del concejal</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Foto del Concejal: </label>
            <div class="input-group">
                <input type="file" name="file" accept="image/png" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection