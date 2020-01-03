@extends('layouts.dashboard')
@section('titulo')
    Plan de Adquisiciones
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/archivo') }}"><span class="hide-menu">Archivos</span></a></li> --}}
@stop
@section('content')

<div class="col-xs-12 col-sm-12 col-md-12 formularioContractual">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Plan de Adquisiciones</h2>
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
            
    <div class="tab-content col-sm-12" > 

        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <br>
            <br>
                <label>Fecha del Plan: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" value="{{$Plan->ff_document}}" disabled>
                </div>
                <small class="form-text text-muted">Fecha asignada al plan de adquisiciones</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" value="{{$Plan->name}}" disabled>
                </div>
                <small class="form-text text-muted">Nombre asignado al plan de adquisiciones</small>
            </div>
        </div>

 <div class="row">
        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
            <a href="{{Storage::url($Plan->resource->ruta)}}" title="Ver" class="btn btn-success btn-raised btn-lg"><i class="fa fa-file-pdf-o"></i></a>
           </div>
            <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
            <form action="{{ route('plan.destroy', $Plan->id) }}" method="POST">
                {{ csrf_field() }}
                {!! method_field('DELETE') !!}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
            </form>
        </div>
    </div>
        </div>

</div>
</div>


@endsection