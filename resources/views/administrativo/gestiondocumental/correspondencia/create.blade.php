@extends('layouts.dashboard')
@section('sidebar')
    <li><a href="{{ route('correspondencia.index') }}" class="btn btn-primary">Correspondencias</a></li>
@stop
@section('content')
    <div class="row">
        <br>
        <div class="col-lg-12 margin-tb">
            <h2 class="text-center"> Creación de Correspondencia de {{ $tipo }}</h2>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
        <br>
        <hr>
        {!! Form::open(array('route' => 'correspondencia.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        <input type="hidden" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
        <input type="hidden" name="secretaria_e" value="0">
        <input type="hidden" name="tipo_doc" value="{{ $id }}">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Usuario: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="user">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>ach
                </select>
                <small class="form-text text-muted">Usuario que se desee asignar a la correspondencia</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Tercero: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="tercero">
                        @foreach($terceros as $tercero)
                            <option value="{{$tercero->id}}">{{$tercero->num_dc}} - {{$tercero->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Relacionar persona</small>
            </div>
        </div>
        @if( $id == 0)
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Fecha de Vencimiento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="fecha_venc" class="form-control">
                    </div>
                    <small class="form-text text-muted">Fecha de Vencimiento de la Correspondencia</small>
                </div>
            </div>
        @elseif( $id == 1)
            <div class="row">
                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <label>Fecha de Salida: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="fecha_salida" class="form-control">
                    </div>
                    <small class="form-text text-muted">Fecha de Salida de la Correspondencia</small>
                </div>
            </div>
        @endif
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
@stop