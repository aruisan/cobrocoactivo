@extends('layouts.dashboard')
@section('titulo')
    Modificar Contrato
@stop
@section('sidebar')
    {{-- <li>
        <a href="{{ url('/contractual') }}" class="btn btn-success">
            <i class="fa fa-file"></i>
            <span class="hide-menu"> Contractual</span></a>
    </li> --}}
@stop
@section('content')
<br>
<div class="col-xs-12 col-sm-12 col-md-12 formularioContractual">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Editar Contrato</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
             <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ url('/contractual') }}" >Volver a Contractual</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">Editar</a>
                </li>
                  
             
            </ul>
            
    <div class="tab-content col-sm-12" >

    <form id="form-create"  method="POST" action="{{url('/contractual/'.$id)}}">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <br><br>
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
<br><br>
            <div class="col-sm-12 " >
            <div class="row">
        <div class="col-sm-6 ">
            <div class="form-group ">
                <button class="btn btn-primary" type="submit">Actualizar</button>
            </div>
        </div>
    </form>
    <div class="col-sm-6 text-center">
        <div class="form-group text-center">
            <form action="{{url('/contractual/'.$id)}}" method="POST">
                {{method_field('DELETE')}}
                {{ csrf_field() }}
                <button class="btn btn-success " type="submit">Eliminar</button>
            </form>
             </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</div>
@stop