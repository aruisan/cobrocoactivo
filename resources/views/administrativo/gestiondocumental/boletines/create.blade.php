@extends('layouts.dashboard')
@section('titulo')
    Crear Boletín
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/boletines') }}"><span class="hide-menu">Boletines</span></a></li> --}}
@stop
@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 formularioBoletin">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Nuevo Boletín</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ asset('/dashboard/boletines') }}" >Volver a Boletines</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">VER</a>
                </li>
             
             
            </ul>
            
    <div class="tab-content col-sm-12" >
  
    <br>
    <hr>
    {!! Form::open(array('route' => 'boletines.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <input type="hidden" name="id_resp" value="{{ $idResp }}">
    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Nombre: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" required>
            </div>
            <small class="form-text text-muted">Nombre que se desee asignar al boletin</small>
        </div>
    

        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Consecutivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="consecutivo" required>
            </div>
            <small class="form-text text-muted">Consecutivo del boletin</small>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Fecha del Documento: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="ff_doc" class="form-control" required>
            </div>
            <small class="form-text text-muted">Fecha que tiene asiganada el documento a subir</small>
        </div>
    

        <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <label>Subir Archivo: </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                <input type="file" name="fileBoletines" accept="application/pdf" class="form-control" required>
            </div>
            <small class="form-text text-muted">Archivo del boletín</small>
        </div>
    </div>


    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
    </div>
    {!! Form::close() !!}
</div>

</div>
</div>

@endsection