@extends('layouts.dashboard')
@section('titulo')
    Editar Registro
@stop
@section('sidebar')
    @include('administrativo.registros.cuerpo.aside')
    @include('administrativo.registros.cuerpo.estado')
@stop
@section('css')
    @include('administrativo.registros.cuerpo.style')
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h3 class="text-center"> Editar Registro: {{ $registro->objeto }}</h3>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <hr>
    <div class="form-validation">
        <form class="form" action="{{url('/administrativo/registros/'.$registro->id)}}" method="POST">
            {!! method_field('PUT') !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <input type="number" class="form-control" name="valor" value="{{ $registro->valor }}">
                    </div>
                    <small class="form-text text-muted">Valor total del registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Datos persona: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                        <input type="text" name="persona_id" class="form-control" data-toggle="modal" data-target="#participante" value="{{ $registro->persona_id }}">
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
                                <option value="{{ $cdp->id }}" @if($cdp->id == $registro->cdp_id) selected @endif>{{ $cdp->id }} - {{ $cdp->name }}</option>
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
                        <textarea name="objeto" class="form-control">{{ $registro->objeto }}</textarea>
                    </div>
                    <small class="form-text text-muted">Nombre del registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Contratos: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        <select name="contrato_id" class="form-control">
                            @foreach($contratos as $contrato)
                                <option value="{{ $contrato->id }}" @if($contrato->id == $registro->contrato_id) selected @endif>{{ $contrato->asunto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Contrato al que pertenece el registro</small>
                </div>
            </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <label>Nombre del Archivo: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                            @if( $registro->ruta == "")
                                El registro no tiene un archivo asignado
                                @else
                                {{ $registro->ruta }}
                                @endif
                        </div>
                        <small class="form-text text-muted">Nombre del archivo al momento de la creación</small>
                    </div>
                </div>
            <div class="row">
                @if($registro->observacion == "")
                @else
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label>Observación del Rechazo </label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            <textarea disabled class="form-control">{{ $registro->observacion }}</textarea>
                        </div>
                        <small class="form-text text-muted">Observación del rechazo del registro.</small>
                    </div>
                @endif
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="{{url('/administrativo/registros/'.$registro->id.'/'.$rol.'/3')}}"  class="btn btn-success">Finalizar</a>
                <button type="submit" class="btn btn-primary" id="storeRegistro">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection