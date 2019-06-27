@extends('layouts.dashboard')
@section('titulo')
    Crear Impuesto Municipal
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ '/administrativo/contabilidad/impumuni' }}"><span class="hide-menu">Impuestos Municipales</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Impuesto Municipal</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    {!! Form::open(array('route' => 'impumuni.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Concepto: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="concept" required>
            </div>
            <small class="form-text text-muted">Concepto de la retención</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Base: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input type="number" name="base" class="form-control" required>
            </div>
            <small class="form-text text-muted">Base de la retención</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Tarifa: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                <input type="number" name="tarifa" class="form-control" required>
            </div>
            <small class="form-text text-muted">Tarifa de la retención</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Codigo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="number" name="codigo" class="form-control" required>
            </div>
            <small class="form-text text-muted">Codigo de la retención</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <label>Cuenta: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" name="cuenta" class="form-control" required>
            </div>
            <small class="form-text text-muted">Cuenta de la retención</small>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection