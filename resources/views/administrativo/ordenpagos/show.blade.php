@extends('layouts.dashboard')
@section('titulo')
    Información Orden de Pago
@stop
@section('sidebar')
    <li> <a href="{{ url('/administrativo/ordenPagos/'.$vigencia_id) }}" class="btn btn-success"><span class="hide-menu">&nbsp; Ordenes de Pago</span></a></li>
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
                        <td class="text-center"><b>Total</b></td>
                        <td><b>$<?php echo number_format($OrdenPagoDescuentos->sum('valor'),0) ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <br>
    @if($OrdenPago->estado == 1)
        <li> <a href="{{ url('/administrativo/ordenPagos/pdf/'.$OrdenPago->id) }}" target="_blank" class="btn btn-primary"><span class="hide-menu"><i class="fa fa-file-pdf-o"></i>&nbsp; Orden de Pago</span></a></li>
        <li> <a href="{{ url('/administrativo/pagos/create/') }}" class="btn btn-success"><span class="hide-menu"><i class="fa fa-credit-card"></i>&nbsp; Pagar</span></a></li>
    @else
        <li> <a href="{{ url('/administrativo/ordenPagos/monto/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu"> Asignación de Monto</span></a></li>
        <li> <a href="{{ url('/administrativo/ordenPagos/descuento/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu">Descuentos</span></a></li>
        <li> <a href="{{ url('/administrativo/ordenPagos/liquidacion/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu"> Contabilizacion</span></a></li>
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
    <div class="col-md-12 align-self-center" style="background-color: white">
        <hr>
        <center>
            <h3>Descuentos</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaDesc">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Base</th>
                    <th class="text-center">Valor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($OrdenPagoDescuentos as  $PagosDesc)
                    <tr class="text-center">
                        @if($PagosDesc->retencion_fuente_id == null)
                            <td>{{ $PagosDesc->descuento_mun['codigo'] }}</td>
                        @else
                            <td>{{ $PagosDesc->descuento_retencion->codigo}}</td>
                        @endif
                        <td>{{ $PagosDesc->nombre }}</td>
                        @if($PagosDesc->retencion_fuente_id == null)
                            <td>$ <?php echo number_format($PagosDesc->descuento_mun['base'],0);?></td>
                        @else
                            <td>$ <?php echo number_format($PagosDesc->descuento_retencion->base,0);?></td>
                        @endif
                        <td>$ <?php echo number_format($PagosDesc['valor'],0);?></td>
                    </tr>
                @endforeach
                <tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
                    <td colspan="3"><b>Total Descuentos</b></td>
                    <td><b>$ <?php echo number_format($OrdenPagoDescuentos->sum('valor'),0);?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <center>
            <h3>Presupuesto</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaP">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Fuente Financiación</th>
                    <th class="text-center">Registro</th>
                    <th class="text-center">Valor</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < $R->cdpRegistroValor->count(); $i++)
                    <tr class="text-center">
                        <td>
                            @for($x = 0; $x < count($infoRubro); $x++)
                                @if($infoRubro[$x]['id_rubro'] == $R->cdpRegistroValor[$i]->fontRubro->fontVigencia->fontsRubro[0]->rubro_id)
                                    {{ $infoRubro[$x]['codigo'] }}
                                @endif
                            @endfor
                        </td>
                        <td>{{ $R->cdpRegistroValor[$i]->fontRubro->rubro->name}}</td>
                        <td>{{ $R->cdpRegistroValor[$i]->fontRubro->fontVigencia->font->code }} - {{ $R->cdpRegistroValor[$i]->fontRubro->fontVigencia->font->name }}</td>
                        <td>{{ $OrdenPago->registros->objeto }}</td>
                        <td>$ <?php echo number_format($OrdenPago->registros->valor,0);?></td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
        <hr>
        <center>
            <h3>Contabilización</h3>
        </center>
        <hr>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaP">
                <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Tercero</th>
                    <th class="text-center">Debito</th>
                    <th class="text-center">Credito</th>
                </tr>
                </thead>
                <tbody>
                @for($z = 0; $z < $OrdenPago->pucs->count(); $z++)
                    <tr class="text-center">
                        <td>{{$OrdenPago->pucs[$z]->data_puc->codigo}}</td>
                        <td>{{$OrdenPago->pucs[$z]->data_puc->nombre_cuenta}}</td>
                        <td>{{ $OrdenPago->registros->persona->num_dc }} {{ $OrdenPago->registros->persona->nombre }}</td>
                        <td>$<?php echo number_format($OrdenPago->pucs[$z]->valor_debito,0);?></td>
                        <td>$<?php echo number_format($OrdenPago->pucs[$z]->valor_credito,0);?></td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
    @stop
