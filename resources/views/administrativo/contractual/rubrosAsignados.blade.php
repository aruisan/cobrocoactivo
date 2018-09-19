@extends('layouts.dashboard')
@section('titulo')
    Rubros Asignados
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-success" data-toggle="dropdown">
            <span class="hide-menu">Movimientos</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{ url('/administrativo/cdp') }}" class="btn btn-success">CDP's</a>
            </li>
            <li>
                <a href="{{ url('/administrativo/cdp/create') }}" class="btn btn-success">Solicitud CDP</a>
            </li>
            <li>
                <a href="{{ url('/administrativo/registros') }}" class="btn btn-success">Registros</a>
            </li>
            <li>
                <a href="{{ url('/administrativo/registros/create') }}" class="btn btn-success">Solicitud Registro</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
    </li>
    <li>
        <a href="{{ url('/almacen') }}" class="btn btn-primary">
            <i class="fa fa-inventory"></i>
            <span class="hide-menu">Almacen</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <h2 class="alert alert-warning">Rubros Asignados</h2>
        @if(isset($datas))
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
        @else
            <div class="alert alert-danger">Actualmente no hay rubros asignados.</div>
        @endif
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
