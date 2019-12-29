@extends('layouts.dashboard')
@section('titulo')
    Ordenes de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos/create/'.$id) }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            <span class="hide-menu"> Crear Orden de Pago</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/pagos') }}" class="btn btn-primary">
            <span class="hide-menu"> Pagos</span></a>
    </li>
    <li>
        <a href="{{ url('/administrativo/registros/'.$id) }}" class="btn btn-primary">
            <span class="hide-menu"> Registros</span></a>
    </li>
@stop
@section('content')
    <div class="breadcrumb text-center">
        <strong>
            <h4><b>Ordenes de Pago</b></h4>
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
                @if(count($ordenPagoTarea) > 0)
                    <table class="table table-bordered" id="tabla_CDP">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Registro</th>
                            <th class="text-center">Tercero</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ordenPagoTarea as $ordenPagoT)
                            <tr class="text-center">
                                <td>{{ $ordenPagoT['info']->id }}</td>
                                <td>{{ $ordenPagoT['info']->nombre }}</td>
                                <td>$<?php echo number_format($ordenPagoT['info']->valor,0) ?></td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($ordenPagoT['info']->estado == "0")
                                            Pendiente
                                        @elseif($ordenPagoT['info']->estado == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">{{ $ordenPagoT['info']->registros->objeto }}</td>
                                <td class="text-center">{{ $ordenPagoT['persona'] }}</td>
                                <td>
                                    <a href="{{ url('administrativo/ordenPagos/'.$ordenPagoT['info']->id.'/edit') }}" title="Editar" class="btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{ url('administrativo/ordenPagos/show/'.$ordenPagoT['info']->id) }}" title="Ver Orden de Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('administrativo/ordenPagos/monto/create/'.$ordenPagoT['info']->id) }}" title="Asignación de Monto" class="btn-sm btn-primary"><i class="fa fa-usd"></i></a>
                                    <a href="{{ url('administrativo/ordenPagos/descuento/create/'.$ordenPagoT['info']->id) }}" title="Descuentos" class="btn-sm btn-success"><i class="fa fa-usd"></i><i class="fa fa-arrow-down"></i></a>
                                    <a href="{{ url('administrativo/ordenPagos/liquidacion/create/'.$ordenPagoT['info']->id) }}" title="Contabilización" class="btn-sm btn-primary"><i class="fa fa-calculator"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay ordenes de pago pendientes.
                        </center>
                    </div>
                @endif
            </div>
        </div>
        <div id="tabHistorico" class="tab-pane fade"><br>
            <div class="table-responsive">
                @if(count($ordenPagos) > 0)
                    <table class="table table-bordered" id="tabla_Historico">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Concepto</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ordenPagos as $ordenPago)
                            <tr class="text-center">
                                <td>{{ $ordenPago['id'] }}</td>
                                <td>{{ $ordenPago['nombre'] }}</td>
                                <td>$<?php echo number_format($ordenPago['valor'],0) ?></td>
                                <td>
                                    <span class="badge badge-pill badge-danger">
                                        @if($ordenPago['estado'] == "0")
                                            Pendiente
                                        @elseif($ordenPago['estado'] == "1")
                                            Finalizado
                                        @else
                                            Anulado
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('administrativo/ordenPagos/show/'.$ordenPago['id']) }}" title="Ver Orden de Pago" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <br><br>
                    <div class="alert alert-danger">
                        <center>
                            No hay ordenes de pago finalizados.
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