@extends('layouts.dashboard')
@section('titulo')
    Modificar Contrato
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/contractual') }}" class="btn btn-success">
            <i class="fa fa-file"></i>
            <span class="hide-menu"> Contractual</span></a>
    </li>
@stop
@section('content')
<br>
<div class="col-xs-hidden col-sm-1 col-md-2 col-lg-3 "></div>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario">
    <center><label>Formulario de Creación De Contrato</label></center>
    <form id="form-create"  method="POST" action="{{url('/contractual/'.$id)}}">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <label>Responsable:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="responsable" value="{{ $data->responsable }}">
        </div>
        <small class="form-text text-muted">Nombre completo del responsable del contrato</small>

        <br>

        <label>Valor: </label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
            <input type="number" class="form-control" name="valor" value="{{ $data->valor }}">

        </div>
        <small class="form-text text-muted">Valor del contrato</small>
        <br>

        <label>Asunto: </label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="asunto"  value="{{ $data->asunto }}">
        </div>
        <small class="form-text text-muted">Asunto del contrato</small>
        <div class="row">
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">Actualizar</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="form-group text-center">
            <form action="{{url('/contractual/'.$id)}}" method="POST">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <button class="btn btn-danger btn-lg" type="submit">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@stop