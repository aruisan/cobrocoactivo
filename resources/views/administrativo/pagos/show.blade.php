@extends('layouts.dashboard')
@section('titulo')
    Información de Pago
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/pagos/'.$pago->orden_pago->registros->cdpsRegistro[0]->cdp->vigencia_id) }}" class="btn btn-success"><span class="hide-menu">&nbsp; Pagos</span></a></li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor Pago</b></h4>
        </center>
        <div class="text-center">
            @if($pago->valor > 0)
                $<?php echo number_format($pago->valor,0) ?>
            @else
                $0.00
            @endif
        </div>
        <br>
        <center>
            <h4><b>Valor Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($ordenPago->valor > 0)
                $<?php echo number_format($ordenPago->valor,0) ?>
            @else
                $0.00
            @endif
        </div>
        <br>
        <center>
            <h4><b>Valor Disponible Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($ordenPago->saldo > 0)
                $<?php echo number_format($ordenPago->saldo,0) ?>
            @else
                $0.00
            @endif
        </div>
        <br>
    </div>
    <br>
    @if($pago->estado == 1)
        <li> <a href="{{ url('/administrativo/ordenPagos/pdf/'.$ordenPago->id) }}" target="_blank" class="btn btn-primary"><span class="hide-menu"><i class="fa fa-file-pdf-o"></i>&nbsp; Orden de Pago</span></a></li>
         <li> <a href="{{ url('/administrativo/egresos/pdf/'.$ordenPago->id) }}" target="_blank" class="btn btn-success"><span class="hide-menu"><i class="fa fa-file-pdf-o"></i> &nbsp; Comprobante de Egresos</span></a></li>
        @else
        <li>
            <a href="{{ url('/administrativo/pagos/asignacion/'.$pago->id) }}" class="btn btn-primary">
                <span class="hide-menu">Asignar Monto</span></a>
        </li>
        <li>
            <a href="{{ url('/administrativo/pagos/banks/'.$pago->id) }}" class="btn btn-primary">
                <span class="hide-menu">Bancos</span></a>
        </li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h3>Concepto de la Orden de Pago: {{ $ordenPago->nombre }}</h3></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Nombre:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $ordenPago->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Registro:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $ordenPago->registros->objeto }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Tercero:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $ordenPago->registros->persona->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Fecha de Creación:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $ordenPago->created_at }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-self-center" style="background-color: white">
        <hr>
        <center>
            <h3>Movimiento Bancario</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaP">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Banco / Cuenta</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Valor</th>
                </tr>
                </thead>
                <tbody>
                @for($y = 0; $y < count($pago->banks); $y++)
                    <tr class="text-center">
                        <td>{{ $pago->banks[$y]->data_puc->codigo }}</td>
                        <td>{{ $pago->banks[$y]->data_puc->nombre_cuenta }}</td>
                        @if($pago->type_pay == "ACCOUNT")
                            @php( $date = strftime("%d of %B %Y", strtotime($pago->banks[$y]->created_at)))
                            <td> Núm Cuenta: {{$pago->num}} - Fecha: {{$date}}</td>
                        @elseif($pago->type_pay == "CHEQUE")
                            @php( $date = strftime("%d of %B %Y", strtotime($pago->banks[$y]->created_at)))
                            <td> Núm Cheque: {{$pago->num}} - Fecha: {{$date}}</td>
                        @endif
                        <td>$<?php echo number_format($pago->banks[$y]->valor,0);?></td>
                    </tr>
                @endfor
                <tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
                    <td colspan="3"><b>Total</b></td>
                    <td><b>$<?php echo number_format($pago->banks->sum('valor'),0);?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @stop
