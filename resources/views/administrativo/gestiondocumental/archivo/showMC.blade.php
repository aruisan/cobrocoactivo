@extends('layouts.dashboard')
@section('titulo')
    Manual de Contratación
@stop
@section('sidebar')
    <li> <a class="btn btn-primary" href="{{ asset('/dashboard/archivo') }}"><span class="hide-menu">Archivos</span></a></li>
@stop
@section('content')


<div class="col-xs-0 col-sm-0 col-md-2 col-lg-2 ">
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 formularioContractual">
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Manual de Contratación</h2>
    </div>
</div>




    <br>
    <hr>

        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Fecha del Manual: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="ff_doc" class="form-control" value="{{$Manual->ff_document}}" disabled>
                </div>
                <small class="form-text text-muted">Fecha asignada al manual de contratación</small>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Nombre: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="name" value="{{$Manual->name}}" disabled>
                </div>
                <small class="form-text text-muted">Nombre asignado al manual de contratación</small>
            </div>
        </div>

         <div class="row">
        <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
           
            <a href="{{Storage::url($Manual->resource->ruta)}}" title="Ver" class="btn btn-success btn-raised btn-lg"><i class="fa fa-file-pdf-o"></i></a>
            </div>

             <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
           
            <form action="{{ route('manual.destroy', $Manual->id) }}" method="POST">
                {{ csrf_field() }}
                {!! method_field('DELETE') !!}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
            </form>
       
        </div>

</div>

</div>
@endsection