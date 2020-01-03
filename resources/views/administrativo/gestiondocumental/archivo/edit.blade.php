@extends('layouts.dashboard')
@section('titulo')
    Editar Archivo
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/archivo') }}"><span class="hide-menu">Archivos</span></a></li> --}}
@stop
@section('content')

<div class="col-12 formularioArchivo">
<div class="row">

    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Editar Archivo</h2>
    </div>
</div>


<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
       
        <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ asset('/dashboard/archivo') }}" >Volver a Archivo</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">VER</a>
                </li>
             
             
            </ul>
 
</div>
<div class="tab-content col-sm-12" > 
    <br>
    <hr>
    <form action="{{ asset('/dashboard/archivo/'.$Document->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{$Document->name}}">
                </div>
                <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
            </div>
        

             <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Fecha del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="fecha_doc" class="form-control" required value="{{$Document->ff_document}}">
                </div>
                <small class="form-text text-muted">Fecha que tiene asiganada el documento a subir</small>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Tercero: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select class="form-control" name="tercero">
                        @foreach($terceros as $tercero)
                            <option value="{{$tercero->id}}" @if($tercero->id == $Document->tercero_id) selected @endif>{{$tercero->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Relacionar persona</small>
            </div>
       

            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Número de Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="num_doc" class="form-control" required value="{{$Document->number_doc}}">
                </div>
                <small class="form-text text-muted">Número de Documento</small>
            </div>
        </div>


        <div class="row">
             <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Fecha de Vencimiento del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_vence" class="form-control" required value="{{$Document->ff_vence}}">
                </div>
                <small class="form-text text-muted">Fecha de vencimiento del documento</small>
            </div>
       

            <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="text" name="consecutivo" class="form-control" required value="{{$Document->cc_id}}">
                </div>
                <small class="form-text text-muted">Consecutivo del Archivo</small>
            </div>
        </div>


        <div class="row">
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6"> 
                <label>Estado actual del documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                    <select class="form-control" name="estado">
                            <option value="0" @if($Document->estado == 0) selected @endif>Pendiente</option>
                            <option value="1" @if($Document->estado == 1) selected @endif>Aprobado</option>
                            <option value="2" @if($Document->estado == 2) selected @endif>Rechazado</option>
                            <option value="3" @if($Document->estado == 3) selected @endif>Archivado</option>
                    </select>
                </div>
                <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el documento</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-11 col-sm-11 col-md-11 col-lg-11">
                <label>Archivo: </label>
                <div class="input-group">
                    <a href="{{Storage::url($Document->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
               
                <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
            </div>
        </form>
        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
            <form action="{{ asset('/dashboard/archivo/'.$Document->id) }}" method="post">
                {!! method_field('DELETE') !!}
                {{ csrf_field() }}
                <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
            </form>
        </div>

    </div>

</div>

</div>
@endsection