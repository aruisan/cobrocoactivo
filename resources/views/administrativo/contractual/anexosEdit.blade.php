@extends('layouts.dashboard')
@section('titulo')
    Modificar Anexo
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/contractual/'.$Anexo->contractual_id.'/anexos') }}"><span class="hide-menu">Anexos del Contrato</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Anexo: {{ $Anexo->name }}</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    <form action="{{ asset('/contractual/anexos/'.$Anexo->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('POST') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{$Anexo->name}}">
                </div>
                <small class="form-text text-muted">Nombre asignado al anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{$Anexo->ff_doc}}">
                </div>
                <small class="form-text text-muted">Fecha que tiene asiganada el anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Número: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="num_doc" class="form-control" value="{{$Anexo->num_doc}}">
                </div>
                <small class="form-text text-muted">Número del Anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Vencimiento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_vence" class="form-control" value="{{$Anexo->ff_vence}}">
                </div>
                <small class="form-text text-muted">Fecha de vencimiento del anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="consecutivo" class="form-control" value="{{$Anexo->consecutivo}}">
                </div>
                <small class="form-text text-muted">Concecutivo del Anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Estado actual: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                        <option value="0" @if($Anexo->estado == 0) selected @endif>Pendiente</option>
                        <option value="1" @if($Anexo->estado == 1) selected @endif>Aprobado</option>
                        <option value="2" @if($Anexo->estado == 2) selected @endif>Rechazado</option>
                        <option value="3" @if($Anexo->estado == 3) selected @endif>Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label>Cambiar Archivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                    <input type="file" name="fileAnexosU" accept="application/pdf" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-6 col-sm-12 col-md-12 col-lg-12 text-center">
            <a href="{{Storage::url($Anexo->resource->ruta)}}" title="Ver" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i></a>
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
        </div>
    </form>
    <div class="form-group col-xs-6 col-sm-12 col-md-12 col-lg-12 text-center">
        <form action="{{ asset('/contractual/anexos/'.$Anexo->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
        </form>
    </div>
</div>
@endsection