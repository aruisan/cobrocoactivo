@extends('layouts.dashboard')
@section('titulo')
    CDP's
@stop
@section('sidebar')
    @if( $rol == 2)
        <li>
            <a href="{{ url('/administrativo/cdp/create/'.$vigencia_id) }}" class="btn btn-success">
                <i class="fa fa-plus"></i>
                <span class="hide-menu"> Crear CDP</span></a>
        </li>
    @endif
    <li>
        <a href="{{ url('/administrativo/registros/'.$vigencia_id) }}" class="btn btn-primary">
            <span class="hide-menu">Registros</span></a>
    </li>
    <li>
        <a href="{{ url('/dashboard/contractual') }}" class="btn btn-primary">
            <span class="hide-menu">Contractual</span></a>
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
    <div class="tab-content" style="background-color: white">
        <br>
        <div id="tabTareas" class="tab-pane active">
            <div class="table-responsive">
                @if(count($cdpTarea) > 0)
                    <table class="table table-bordered" id="tabla_CDP">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Objeto</th>
                            <th class="text-center">Estado Secretaria</th>
                            <th class="text-center">Estado Jefe</th>
                            <th class="text-center">Valor</th>
                            @if($rol == 2)
                                <th class="text-center"><i class="fa fa-usd"></i></th>
                                <th class="text-center"><i class="fa fa-edit"></i></th>
                            @elseif ($rol == 3)
                                <th class="text-center">Aprobar</th>
                                <th class="text-center">Ver</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cdpTarea as $cdp)
                            <tr>
                                <td class="text-center">{{ $cdp->id }}</td>
                                <td class="text-center">{{ $cdp->name }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($cdp->secretaria_e == "0")
                                            Pendiente
                                        @elseif($cdp->secretaria_e == "1")
                                            Rechazado
                                        @elseif($cdp->secretaria_e == "2")
                                            Anulado
                                        @else
                                            Enviado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($cdp->jefe_e == "0")
                                            Pendiente
                                        @elseif($cdp->jefe_e == "1")
                                            Rechazado
                                        @elseif($cdp->jefe_e == "2")
                                            Anulado
                                        @elseif($cdp->jefe_e == "3")
                                            Aprobado
                                        @else
                                            En Espera
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">$<?php echo number_format($cdp->rubrosCdpValor->sum('valor_disp'),0) ?></td>
                                @if($rol == 2)
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$vigencia_id.'/'.$cdp->id) }}" title="Ingresar Dinero al CDP" class="btn-sm btn-primary"><i class="fa fa-usd"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$vigencia_id.'/'.$cdp->id.'/edit') }}" title="Editar CDP" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                                @elseif($rol == 3)
                                    <td class="text-center">
                                        <input type="checkbox" class="form-group">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('administrativo/cdp/'.$vigencia_id.'/'.$cdp->id) }}" title="Ver CDP" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay CDP's pendientes.
                        </center>
                    </div>
                @endif
            </div>
        </div>
        <div id="tabHistorico" class="tab-pane fade">
            <div class="table-responsive">
                @if(count($cdps) > 0)
                    <table class="table table-bordered" id="tabla_Historico">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Objeto</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">Ver</th>
                            <th class="text-center">PDF</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cdps as $cdp)
                            <tr>
                                <td class="text-center">{{ $cdp->id }}</td>
                                <td class="text-center">{{ $cdp->name }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-danger">
                                        @if($cdp->jefe_e == "0")
                                            Pendiente
                                        @elseif($cdp->jefe_e == "1")
                                            Rechazado
                                        @elseif($cdp->jefe_e == "2")
                                            Anulado
                                        @elseif($cdp->jefe_e == "3")
                                            Aprobado
                                        @else
                                            En Espera
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">$<?php echo number_format($cdp->valor,0) ?></td>
                                <td class="text-center">$<?php echo number_format($cdp->saldo,0) ?></td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/'.$vigencia_id.'/'.$cdp->id) }}" title="Ver CDP" class="btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('administrativo/cdp/pdf/'.$cdp['id'].'/'.$vigencia_id) }}" title="File" class="btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay CDP's finalizados
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
            "searching": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );

        $('#tabla_Historico').DataTable( {
            responsive: true,
            "searching": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        } );
        </script>
@stop