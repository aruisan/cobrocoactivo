@extends('layouts.dashboard')
@section('titulo')
    Editar Resoluciones
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li> --}}
@stop
@section('content')



<div class="col-xs-12 col-sm-12 col-md-12 formularioResolucion">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Editar Resolución</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ asset('/dashboard/acuerdos') }}" >Volver a Acuerdos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">Editar</a>
                </li>
             
             
            </ul>
            
    <div class="tab-content col-sm-12" >
    <br>
    <hr>
    <form action="{{ asset('/dashboard/acuerdos/resoluciones/'.$Resolucion->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}


        <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" required value="{{ $Resolucion->name }}">
                </div>
                <small class="form-text text-muted">Nombre de la resolución</small>
            </div>
        
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Fecha del Documento: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" required value="{{ $Resolucion->ff_document }}">
                </div>
                <small class="form-text text-muted">Fecha del Documento en el que se encuentra la resolución</small>
            </div>
        </div>


        <div class="row">
          <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Consecutivo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="cc_id" class="form-control" required value="{{ $Resolucion->cc_id }}">
                </div>
                <small class="form-text text-muted">Consecutivo asignado a la resolución</small>
            </div>
      
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Comisión: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                    <select class="form-control" name="comision_id">
                        @foreach($Comisiones as $comision)
                            <option value="{{$comision->id}}" @if($comision->id == $Resolucion->comision_id) selected @endif>{{$comision->id}} - {{$comision->name}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="form-text text-muted">Comisión asignada a la resolución</small>
            </div>
        </div>

         <div class="row">
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Archivo: </label>
                     <a href="{{Storage::url($Resolucion->resource->ruta)}}" title="Ver" class="btn btn-success"><i class="fa fa-file-pdf-o"></i></a>
            </div>
        </div>
        
         <div class="row">
                <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">  
                    <button class="btn btn-primary btn-raised btn-lg" id="storeRegistro">Guardar</button>
                </div>
            </form>
       
            <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
                <form action="{{ asset('/dashboard/acuerdos/resoluciones/'.$Resolucion->id) }}" method="post">
                    {!! method_field('DELETE') !!}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
                </form>
            </div>
        </div>

   </div>
    </div>

</div>
@endsection