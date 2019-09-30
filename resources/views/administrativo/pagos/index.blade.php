@extends('layouts.dashboard')
@section('titulo')
    Pagos
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos/create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu"> Crear Pago</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/ordenPagos') }}" class="btn btn-primary">
            <span class="hide-menu"> Ordenes de Pago</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/registros') }}" class="btn btn-primary">
            <span class="hide-menu"> Registros</span></a>
    </li>
@stop
@section('content')
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Pagos</b></h4>
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
                @if(count($pagosTarea) > 0)
                    <table class="table table-bordered" id="tabla_Fin">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Tercero</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagosTarea as $pagoT)
                            <tr class="text-center">
                                <td>{{ $pagoT->id }}</td>
                                <td>{{ $pagoT->orden_pago->nombre}}</td>
                                <td>$<?php echo number_format($pagoT->valor,0) ?></td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($pagoT->estado == "0")
                                            Pendiente
                                        @elseif($pagoT->estado == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">{{ $pagoT->orden_pago->registros->persona->nombre }}</td>
                                <td>
                                    <a href="{{ url('administrativo/pagos/'.$pagoT->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('administrativo/pagos/'.$pagoT->id) }}" title="Ver Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('administrativo/pagos/asignacion/'.$pagoT->id) }}" title="Asignar Monto" class="btn-sm btn-success"><i class="fa fa-usd"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay pagos pendientes.
                        </center>
                    </div>
                @endif
            </div>
        </div>
        <div id="tabHistorico" class="tab-pane fade">
            <br>
            <br>
            <div class="table-responsive">
                @if(count($pagos) > 0)
                    <table class="table table-bordered" id="tabla_Historico">
                        <thead>
                        <tr>
                            <th class="text-center">Id Pago</th>
                            <th class="text-center">Id Orden de Pago</th>
                            <th class="text-center">Concepto Orden de Pago</th>
                            <th class="text-center">Valor Pago</th>
                            <th class="text-center">Tercero</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagos as $pago)
                            <tr class="text-center">
                                <td>{{ $pago->id }}</td>
                                <td><a href="{{ url('administrativo/ordenPagos/'.$pago->orden_pago_id) }}">{{ $pago->orden_pago_id }}</a></td>
                                <td>{{ $pago->orden_pago->nombre }}</td>
                                <td>$<?php echo number_format($pago->valor,0) ?></td>
                                <td>{{ $pago->orden_pago->registros->persona->nombre }}</td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($pago->estado == "0")
                                            Pendiente
                                        @elseif($pago->estado == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('administrativo/pagos/'.$pago->id) }}" title="Ver Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay pagos finalizados.
                        </center>
                    </div>
                @endif
            </div>
        </div>
@stop
@section('js')
    <script>
        $('#tabla_Fin').DataTable( {
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