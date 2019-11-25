@extends('layouts.dashboard')
@section('titulo')
    Agregar Plan de Adquisiciones
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/archivo') }}"><span class="hide-menu">Archivos</span></a></li>
@stop
@section('content')

<div class="col-xs-0 col-sm-0 col-md-2 col-lg-2 ">
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 formularioAdquisicion">
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Agregar Plan de Adquisición</h2>
    </div>
</div>


<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
    <br>
    <hr>
    {!! Form::open(array('route' => 'plan.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-5">
            <label>Fecha: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="ff_doc" class="form-control">
                <input type="hidden" name="id_resp" value="{{ $idResp }}">
            </div>
            <small class="form-text text-muted">Fecha de la elaboración del plan de adquisición</small>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Subir Archivo: </label>
            <div class="input-group">
                <input type="file" name="filePlanA" accept="application/pdf" class="form-control">
            </div>
        </div>
    </div>


    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Agregar</button>
    </div>
    {!! Form::close() !!}
</div>

</div>
@endsection