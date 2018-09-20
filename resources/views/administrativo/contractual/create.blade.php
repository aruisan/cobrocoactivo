@extends('layouts.dashboard')
@section('sidebar')
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-success">
            <i class="fa fa-file"></i>
            <span class="hide-menu"> Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/presupuesto/rubro') }}" class="btn btn-primary">
            <span class="hide-menu"> Presupuesto</span></a>
    </li>
    <li>
        <a href="{{ url('/almacen') }}" class="btn btn-primary">
            <i class="fa fa-inventory"></i>
            <span class="hide-menu"> Almacen</span></a>
    </li>
@stop
@section('content')
<br>
<div class="col-xs-hidden col-sm-1 col-md-2 col-lg-3 "></div>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario">
    <center><label>Formulario de Creación De Contrato</label></center>
    <form id="form-create"  method="POST" action="{{ route('contractual.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Responsable:</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="responsable">
        </div>
        <small class="form-text text-muted">Nombre completo del responsable del contrato</small>

        <br>

        <label>Valor: </label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
            <input type="number" class="form-control" name="valor" >

        </div>
        <small class="form-text text-muted">Valor del contrato</small>
        <br>

        <label>Asunto: </label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="asunto"  >
        </div>
        <small class="form-text text-muted">Asunto del contrato</small>

        <div class="row">
            <div class="form-group">
                <button class="btn btn-danger ocultar" id="contractual">Cancelar</button>
                <button class="btn btn-primary btn-block" type="submit">Nuevo Contrato</button>
            </div>
        </div>
    </form>
</div>
@stop