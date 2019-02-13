@extends('layouts.dashboard')
@section('titulo')
    Crear Anexo
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/contractual/'.$Contrato->id.'/anexos') }}"><span class="hide-menu">Contrato</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Anexo Contrato: {{ $Contrato->asunto }}</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    <form action="{{ asset('/contractual/'.$Contrato->id.'/anexos') }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('POST') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar al anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del Anexo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required>
                </div>
                <small class="form-text text-muted">Fecha que tiene asiganada el anexo a subir</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Número de Anexo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="num_doc" class="form-control">
                </div>
                <small class="form-text text-muted">Número del Anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha de Vencimiento del Anexo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_vence" class="form-control">
                </div>
                <small class="form-text text-muted">Fecha de vencimiento del Anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="consecutivo" class="form-control">
                </div>
                <small class="form-text text-muted">Concecutivo del Anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Estado actual del anexo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                            <option value="0">Pendiente</option>
                            <option value="1">Aprobado</option>
                            <option value="2">Rechazado</option>
                            <option value="3">Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el anexo</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label>Subir Archivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                    <input type="file" name="fileAnexos" accept="application/pdf" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="form-group col-xs-6 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
        </div>
    </form>
</div>
@endsection