@extends('layouts.dashboard')
@section('titulo')
    Pagos
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos/create/'.$id) }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu"> Crear Pago</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/ordenPagos/'.$id) }}" class="btn btn-primary">
            <span class="hide-menu"> Ordenes de Pago</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/registros/'.$id) }}" class="btn btn-primary">
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
                                <td>{{ $pagoT['info']->id }}</td>
                                <td>{{ $pagoT['info']->orden_pago->nombre}}</td>
                                <td>$<?php echo number_format($pagoT['info']->valor,0) ?></td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($pagoT['info']->estado == "0")
                                            Pendiente
                                        @elseif($pagoT['info']->estado == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">{{ $pagoT['info']->orden_pago->registros->persona->nombre }}</td>
                                <td>
                                    <a href="{{ url('administrativo/pagos/show/'.$pagoT['info']->id) }}" title="Ver Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('administrativo/pagos/asignacion/'.$pagoT['info']->id) }}" title="Asignar Monto" class="btn-sm btn-success"><i class="fa fa-usd"></i></a>
                                    <a href="{{ url('administrativo/pagos/banks/'.$pagoT['info']->id) }}" title="Asignar Banco" class="btn-sm btn-success"><i class="fa fa-bank"></i></a>
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
        <div id="tabHistorico" class="tab-pane fade"><br>
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
                                <td>{{ $pago['info']->id }}</td>
                                <td><a href="{{ url('administrativo/ordenPagos/show/'.$pago['info']->orden_pago_id) }}">{{ $pago['info']->orden_pago_id }}</a></td>
                                <td>{{ $pago['info']->orden_pago->nombre }}</td>
                                <td>$<?php echo number_format($pago['info']->valor,0) ?></td>
                                <td>{{ $pago['info']->orden_pago->registros->persona->nombre }}</td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($pago['info']->estado == "0")
                                            Pendiente
                                        @elseif($pago['info']->estado == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('administrativo/pagos/show/'.$pago['info']->id) }}" title="Ver Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
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