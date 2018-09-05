@extends('layouts.dashboard')

@section('content')
    <h2 class="alert alert-warning">Titulación de Predios</h2>
    <table id="table" class="table table-condensed table-hover table-bordered table-responsive">
        <thead>
        <th>PROCESO</th>
        <th>RESPONSABLE</th>
        <th>VALOR</th>
        <th>ASUNTO</th>
        <th>ver</th>
        <th><i class="fa fa-pencil-square-o text-success"></i></th>
        </thead>
        <tbody>
        @foreach($consulta as $data )
            <tr>
                <td>{{$data->modulo}}</td>
                <td>{{$data->responsable}}</td>
                <td>{{$data->valor}}</td>
                <td>{{$data->asunto}}</td>
                <td><a href="contractual/{{$data->id}}/edit " class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a></td>
                <td><a href="{{ route('subirArchivo.show', $data->id ) }}" class="btn btn-warning">ver</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
@section('sidebar')

<li><a href="{{ route('titulacionpredios.create') }}" class="btn btn-primary">Nueva Titulación</a></li>
@stop