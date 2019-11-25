@extends('layouts.dashboard')
@section('titulo')
    Informe Presupuestal
@stop
@section('sidebar')
    <li class="dropdown">
        <a class="dropdown-toggle btn btn btn-primary" data-toggle="dropdown" href="#">
            <span class="hide-menu">Niveles</span>
            &nbsp;
            <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            @foreach($levels as $level)
                <li><a href="/presupuesto/informes/lvl/{{$level->level}}" class="btn btn-primary">Nivel {{ $level->level }}</a></li>
            @endforeach
            <li><a href="/presupuesto/informes/rubros" class="btn btn-primary">Rubros</a></li>
        </ul>
    </li>@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Informes Presupuestales Por Niveles</b></h4>
            </strong>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered hover" id="tabla">
                <hr>
                <thead>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                </thead>
                <tbody>
                @foreach($values as $value)
                    <tr>
                        <td class="text-center">{{$value['cod']}}</td>
                        <td class="text-center">{{$value['name']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#tabla').DataTable( {
            responsive: true,
            "searching": true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
    </script>
@stop