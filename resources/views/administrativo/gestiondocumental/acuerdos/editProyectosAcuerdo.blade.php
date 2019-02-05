@extends('layouts.dashboard')
@section('titulo')
    Editar Proyecto de Acuerdo
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Editar Proyecto de Acuerdo</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <hr>
    <form action="{{ asset('/dashboard/acuerdos/proyectos/'.$ProyAcuerdo->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{ $ProyAcuerdo->name }}">
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{ $ProyAcuerdo->ff_document }}">
                </div>
                <small class="form-text text-muted">Fecha del Documento</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Comisión: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                    <select class="form-control" name="comision_id">
                        @foreach($Comisiones as $comision)
                            <option value="{{$comision->id}}" @if($comision->id == $ProyAcuerdo->comision_id) selected @endif>{{$comision->id}} - {{$comision->name}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Comisión asignada al acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="cc_id" class="form-control" required value="{{ $ProyAcuerdo->cc_id }}">
                </div>
                <small class="form-text text-muted">Consecutivo asignado al proyecto de acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Estado actual del proyecto de acuerdo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                        <option value="0" @if($ProyAcuerdo->estado == 0) selected @endif>Pendiente</option>
                        <option value="1" @if($ProyAcuerdo->estado == 1) selected @endif>Aprovado</option>
                        <option value="2" @if($ProyAcuerdo->estado == 2) selected @endif>Rechazado</option>
                        <option value="3" @if($ProyAcuerdo->estado == 3) selected @endif>Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el proyecto de acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Salida: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_salida" class="form-control" required value="{{ $ProyAcuerdo->ff_salida }}">
                </div>
                <small class="form-text text-muted">Fecha de salida del proyecto de acuerdo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de 1er debate: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_primerdbt" class="form-control" required value="{{ $ProyAcuerdo->ff_primerdbte }}">
                </div>
                <small class="form-text text-muted">Fecha del primer debate</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del 2do debate: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_segundodbt" class="form-control" required value="{{ $ProyAcuerdo->ff_segundodbte }}">
                </div>
                <small class="form-text text-muted">Fecha del segundo debate</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Concejal Ponente: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="ponente_id">
                        @foreach($Concejales as $concejal)
                            <option value="{{$concejal->id}}" @if($concejal->id == $ProyAcuerdo->ponente_id) selected @endif>{{$concejal->persona->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Concejal ponente</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Concejal: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="concejal_id">
                        @foreach($Concejales as $concejal)
                            <option value="{{$concejal->id}}" @if($concejal->id == $ProyAcuerdo->concejal_id) selected @endif>{{$concejal->persona->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Concejal ponente</small>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="{{Storage::url($ProyAcuerdo->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
            <form action="{{ asset('/dashboard/acuerdos/proyectos/'.$ProyAcuerdo->id) }}" method="post">
                {!! method_field('DELETE') !!}
                <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
            </form>
        </div>
    </form>
</div>
@endsection