@extends('layouts.dashboard')

@section('content')



<h2 class="alert alert-warning">Rubros Asignados</h2>
<table id="table" class="table table-condensed table-hover table-bordered table-responsive">
    <thead>
{{--         <th>Dependencia</th>
        <th>Subproyecto</th> --}}
        <th>Cod Rubro</th>
        <th>Nom Rubro</th>
        <th>Dependencia</th>
        <th>Subproyecto</th>
        <th>Valor</th>
{{--
        <th><i class="fa fa-pencil-square-o text-success"></i></th> --}}
    </thead>
    <tbody>
        @foreach($datas as $data )
            <tr>
                <td>{{$data['codRubro']}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['dep']}}</td>
                <td>{{$data['subP']}}</td>
                <td>{{$data['valor']}}</td>
           {{--  <td><a href="contractual/{{$data->id}}/edit " class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a href="{{route('subirArchivoContractual.show', $data->id)}}" class="btn btn-warning">ver</a></td> --}}
        </tr>
        @endforeach
    </tbody>
</table>
@stop
@section('sidebar')
<li>
    <a href="{{ route('contractual.create') }}" class="btn btn-primary waves-effect waves-light active">Nuevo Contractual</a>    
</li>
<li>
    <a href="{{ url('/contractual/rubros') }}" class="btn btn-primary waves-effect waves-light active">ver rubros</a>    
</li>
@stop