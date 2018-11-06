@extends('layouts.dashboard')
@section('titulo')
    CDP's
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/cdp/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu"> Crear CDP</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/registros') }}" class="btn btn-primary">
            <span class="hide-menu">Registros</span></a>
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
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>CDP's</b></h4>
        </strong>
    </div>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tabTareas">TAREAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tabHistorico">HISTORICO</a>
        </li>
    </ul>
    <br>
    <div class="tab-content" style="background-color: white">
        <div id="tabTareas" class="tab-pane active"><br>
            <br>
            <div class="table-responsive">
                @if(count($cdps) >= 1)
                    <table class="table table-bordered" id="tabla_CDP">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Objeto</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-sign-in"></i></th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cdps as $cdp)
                            <tr>
                                <td class="text-center">{{ $cdp->id }}</td>
                                <td class="text-center">{{ $cdp->name }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($cdp->estado == 0)
                                            Pendiente
                                        @elseif($cdp->estado == 1)
                                            Rechazado
                                        @elseif($cdp->estado == 2)
                                            Anulado
                                        @else
                                            Aprobado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">$<?php echo number_format($cdp->valor,0) ?></td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$cdp->id) }}" title="Ingresar" class="btn btn-sm btn-primary"><i class="fa fa-sign-in"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$cdp->id.'/edit') }}" title="Editar" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="#" title="Aprobar" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                    <a href="#" title="Rechazar" class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay CDP's, para crear uno nuevo de click al siguiente link:
                            <a href="{{ url('presupuesto/cdp/create') }}" class="alert-link">Crear CDP</a>.
                        </center>
                    </div>
                @endif
            </div>
        </div>
        <div id="tabHistorico" class="tab-pane fade">
            <br>
            <br>
            <div class="table-responsive">
                @if(count($cdps) >= 1)
                    <table class="table table-bordered" id="tabla_Historico">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Objeto</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-sign-in"></i></th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cdps as $cdp)
                            <tr>
                                <td class="text-center">{{ $cdp->id }}</td>
                                <td class="text-center">{{ $cdp->name }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($cdp->estado == 0)
                                            Pendiente
                                        @elseif($cdp->estado == 1)
                                            Rechazado
                                        @elseif($cdp->estado == 2)
                                            Anulado
                                        @else
                                            Aprobado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">$<?php echo number_format($cdp->valor,0) ?></td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$cdp->id) }}" title="Ingresar" class="btn btn-sm btn-primary"><i class="fa fa-sign-in"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$cdp->id.'/edit') }}" title="Editar" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="#" title="Aprobar" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                    <a href="#" title="Rechazar" class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay CDP's, para crear uno nuevo de click al siguiente link:
                            <a href="{{ url('presupuesto/cdp/create') }}" class="alert-link">Crear CDP</a>.
                        </center>
                    </div>
                @endif
            </div>
        </div>
@stop
@section('js')
    <script>
        $('#tabla_CDP').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_Historico').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 5,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
        </script>
@stop