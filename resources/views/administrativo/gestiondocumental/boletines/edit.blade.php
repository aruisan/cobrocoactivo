@extends('layouts.dashboard')
@section('titulo')
    Editar Boletín
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/boletines') }}"><span class="hide-menu">Boletines</span></a></li>
@stop
@section('content')
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Creación de Boletín</h2>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
    <br>
    <hr>
    <form action="{{ asset('/dashboard/boletines/'.$Document->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{$Document->name}}">
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar al boletin</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="consecutivo" required value="{{$Document->cc_id}}">
                </div>
                <small class="form-text text-muted">Consecutivo del boletin</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{$Document->ff_document}}">
                </div>
                <small class="form-text text-muted">Fecha que tiene asiganada el documento a subir</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <label>Archivo: </label>
                <div class="input-group">
                    <a href="{{Storage::url($Document->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
        </div>
    </form>
    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <form action="{{ asset('/dashboard/boletines/'.$Document->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
        </form>
    </div>


</div>
@endsection