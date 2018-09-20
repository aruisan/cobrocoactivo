@extends('layouts.dashboard')
@section('titulo')
    Registro
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
        <h2 class="text-center"> Registro {{ $registro->objeto }}</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    <div class="form-validation">
        <form class="form" action="{{url('/administrativo/registros/'.$registro->id)}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="fecha" value="{{ $registro->ff_expedicion }}">
            <input type="hidden" name="secretaria_e" value="">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Valor: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        $ <?php echo number_format($registro->valor,0);?>.00
                    </div>
                        <small class="form-text text-muted">Valor total del registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Tercero: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                        {{ $registro->persona->nombre }}
                    </div>
                    <small class="form-text text-muted">Persona asignada al registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Cdp: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        {{ $registro->cdp->name }}
                    </div>
                    <small class="form-text text-muted">CDP al que pertenece el registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Objeto: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <textarea disabled class="form-control">{{ $registro->objeto }}</textarea>
                    </div>
                    <small class="form-text text-muted">Nombre del registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Contrato: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        {{ $registro->contrato->asunto }}
                    </div>
                    <small class="form-text text-muted">Contrato al que pertenece el registro</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Nombre del Archivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                        @if($registro->ruta == "")
                            El registro no posee un archivo
                        @else
                            {{ $registro->ruta }}
                        @endif
                    </div>
                    <small class="form-text text-muted">Nombre del archivo asignado al registro</small>
                </div>
            </div>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <br>
                @if($registro->secretaria_e == 0)
                @else
                    @if($rol == 2)
                    @elseif($rol == 3)
                        @if($registro->jcontratacion_e == 3 or $registro->jcontratacion_e == 1)
                        @else
                            <a href="{{url('/administrativo/registros/'.$registro->id.'/'.$rol.'/3')}}" class="btn btn-success">
                                Aprobar
                            </a>
                            <a href="{{url('/administrativo/registros/'.$registro->id.'/'.$rol.'/1')}}" class="btn btn-danger">
                                Rechazar
                            </a>
                        @endif
                    @else
                    @endif
                @endif
            </div>
        </form>
    </div>
</div>
@endsection