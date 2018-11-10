@extends('layouts.dashboard')
@section('titulo')
    Crear Registros
@stop
@section('sidebar')
  @include('administrativo.registros.cuerpo.aside')
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Registro</h2>
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
            <label>Datos persona: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                <input type="text" name="persona_id" class="form-control" data-toggle="modal" data-target="#participante">
            </div>
            <small class="form-text text-muted">Relacionar persona</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Cdp: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                <select name="cdp_id" class="form-control">
                    @foreach($cdps as $cdp)
                        <option value="{{ $cdp->id }}">{{ $cdp->name }}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">CDP al que pertenece el registro</small>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Objeto: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                <textarea name="objeto" class="form-control"></textarea>
            </div>
            <small class="form-text text-muted">Nombre del registro</small>
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
    <div class="row">
        <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <label>Contratos: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                <select name="contrato_id" class="form-control">
                    @foreach($contratos as $contrato)
                        <option value="{{ $contrato->id }}">{{ $contrato->asunto }}</option>
                    @endforeach
                </select>
            </div>
            <small class="form-text text-muted">Contrato al que pertenece el registro</small>
        </div>
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>
@endsection