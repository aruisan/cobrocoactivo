@extends('layouts.dashboard')
@section('sidebar')
    <li>
        <a href="{{ url('/dashboard/contractual/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu">Crear Contractual</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Contractual</b></h4>
            </strong>
        </div>
        @if(count($consulta)>0)
        <table id="table" class="table table-condensed table-hover table-bordered table-responsive">
            <thead>
                <th>PROCESO</th>
                <th>RESPONSABLE</th>
                <th>VALOR</th>
                <th>ASUNTO</th>
                <th><i class="fa fa-pencil-square-o text-success"></i></th>
                <th>ver</th>
            </thead>
            <tbody>
                @foreach($consulta as $data )

                <tr>
                    <td>{{$data->modulo}}</td>
                    <td>{{$data->responsable}}</td>
                    <td>{{$data->valor}}</td>
                    <td>{{$data->asunto}}</td>
                    <td><a href="contractual/{{$data->id}}/edit " class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td><a href="{{route('subirArchivoContractual.show', $data->id)}}" class="btn btn-warning">ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-danger">
                Actualmente no hay contratos creados, para crearlos de clic en el siguiente enlace:
                <a href="{{ route('contractual.create') }}" class="alert-link">Nuevo Contrato</a>.
            </div>
        @endif
    </div>
@stop