@extends('layouts.dashboard')
@section('titulo')
    Información Orden de Pago
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/ordenPagos') }}" class="btn btn-success"><span class="hide-menu">&nbsp; Ordenes de Pago</span></a></li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($OrdenPago->valor > 0)
                $<?php echo number_format($OrdenPago->valor,0) ?>
            @else
                $0.00
            @endif
        </div>
        <center>
            <h4><b>Valor Disponible Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($OrdenPago->saldo > 0)
                $<?php echo number_format($OrdenPago->saldo,0) ?>
            @else
                $0.00
            @endif
        </div>
        <br>
        <center>
            <h4><b>Valor de Descuentos</b></h4>
        </center>
        <br>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    @foreach( $OrdenPagoDescuentos as $desc)
                    <tr>
                        <td class="text-center">{{ $desc['nombre'] }}</td>
                        <td>$<?php echo number_format($desc['valor'],0) ?></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-center">Total</td>
                        <td>$<?php echo number_format($OrdenPagoDescuentos->sum('valor'),0) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <center>
            <h4><b>Valor Pago por Fechas</b></h4>
        </center>
        <br>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                @foreach( $OrdenPagoFechas as $fechas)
                    <tr>
                        <td class="text-center">{{ $fechas['fecha'] }}</td>
                        <td>$<?php echo number_format($fechas['valor'],0) ?></td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center">Total</td>
                    <td>$<?php echo number_format($OrdenPagoFechas->sum('valor'),0) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    @if($OrdenPago->estado == 1)
    @else
    <li> <a href="{{ url('/administrativo/ordenPagos/descuento/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu">Descuentos</span></a></li>
    <li> <a href="{{ url('/administrativo/ordenPagos/fechas/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu">Fechas</span></a></li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h3>Orden de Pago: {{ $OrdenPago->nombre }}</h3></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Nombre:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $OrdenPago->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Registro:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $OrdenPago->registros->objeto }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Tercero:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $OrdenPago->registros->persona->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Fecha de Creación:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $OrdenPago->created_at }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center">
        <hr>
        <center>
            <h3>Descuentos Orden de Pago</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaDesc">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Valor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($OrdenPagoDescuentos as  $PagosDesc)
                    <tr class="text-center">
                        <td>{{ $PagosDesc->id }}</td>
                        <td>{{ $PagosDesc->nombre }}</td>
                        <td>$ <?php echo number_format($PagosDesc['valor'],0);?>.00</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 align-self-center" style="background-color: white">
            <br>
            <hr>
            <center>
                <h3>Fechas de Pago Asignadas</h3>
            </center>
            <hr>
            <br>
            @if($OrdenPago->estado == 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="tablaFechas">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($OrdenPagoFechas as  $data)
                        <tr class="text-center">
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->fecha }}</td>
                            <td>$ <?php echo number_format($data->valor,0);?>.00</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @elseif($OrdenPago->estado == 1)
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablaFechas">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Factura de Cobro</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($OrdenPagoFechas as  $data)
                            <tr class="text-center">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->fecha }}</td>
                                <td>$ <?php echo number_format($data->valor,0);?>.00</td>
                                <td>
                                    <a href="#" class="btn-sm btn-success"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @if($OrdenPago->estado == 1)
        @elseif($OrdenPagoFechas->count() > 0 and $OrdenPagoDescuentos->count() > 0)
            <form action="{{ asset('administrativo/ordenPagos/fin/'.$OrdenPago->id)}}" method="POST" class="form" enctype="multipart/form-data">
                {!! method_field('PUT') !!}
                {{ csrf_field() }}
                <br>
                <center>
                    <button class="btn btn-success btn-raised btn-lg">Finalizar Orden de Pago</button>
                </center>
            </form>
        @endif
    </div>
    @stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaDesc').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

            $('#tablaFechas').DataTable( {
                responsive: true,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );

        } );
    </script>
@stop
