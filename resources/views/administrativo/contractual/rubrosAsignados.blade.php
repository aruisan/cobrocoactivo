@extends('layouts.dashboard')

@section('content')

@section('sidebar')
@include('administrativo.contractual.sideBar')
@stop

<h2 class="alert alert-warning">Rubros Asignados</h2>
<div class="table-responsive">
    <br>
    <table id="tablaRubro" class="table table-condensed table-hover table-bordered table-responsive">
        <thead>
{{--         <th>Dependencia</th>
    <th>Subproyecto</th> --}}
    <th>Cod Rubro</th>
    <th>Nom Rubro</th>
    <th>Dependencia</th>
    <th>Subproyecto</th>
    <th>Valor</th>
    <th>Ver</th>
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
        <td class="text-center">
            <a href="{{ url('presupuesto/rubro/'.$data['idRubro']) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
</div>
@stop

@section('js')
<script>
    $('#tablaRubro').DataTable( {
        responsive: true,
        "searching": true
    } );
</script>
@stop
