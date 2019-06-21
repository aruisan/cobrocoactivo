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
        <li> <a href="{{ url('/administrativo/ordenPagos/pdf/'.$OrdenPago->id) }}" target="_blank" class="btn btn-success"><span class="hide-menu"><i class="fa fa-file-pdf-o"></i>&nbsp; Orden de Pago</span></a></li>
        <li> <a href="{{ url('/administrativo/egresos/pdf/'.$OrdenPago->id) }}" target="_blank" class="btn btn-success"><span class="hide-menu"><i class="fa fa-file-pdf-o"></i> &nbsp; Comprobante de Egresos</span></a></li>
    @else
    <li> <a href="{{ url('/administrativo/ordenPagos/descuento/create/'.$OrdenPago->id) }}" class="btn btn-primary"><span class="hide-menu">Descuentos</span></a></li>
    <li> <a href="{{ url('/administrativo/ordenPagos/liquidacion/create/'.$OrdenPago->id) }}" class="btn btn-success"><span class="hide-menu"><i class="fa fa-credit-card"></i>&nbsp; Liquidar</span></a></li>
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
                                @if($infoRubro[$x]['id_rubro'] == $R->cdpRegistroValor[$i]->fontRubro->rubro->id)
                                    {{ $infoRubro[$x]['codigo'] }}
                                @endif
                            @endfor
                        </td>
                        <td>{{ $R->cdpRegistroValor[$i]->fontRubro->rubro->name}}</td>
                        <td>{{ $R->cdpRegistroValor[$i]->fontRubro->font->code }} - {{ $R->cdpRegistroValor[$i]->fontRubro->font->name }}</td>
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
                @for($y = 0; $y < count($OrdenPago->payments); $y++)
                    <tr class="text-center">
                        <td>{{ $OrdenPago->payments[$y]->data_puc->codigo }}</td>
                        <td>{{ $OrdenPago->payments[$y]->data_puc->nombre_cuenta }}</td>
                        <td>{{ $OrdenPago->registros->persona->num_dc }} {{ $OrdenPago->registros->persona->nombre }}</td>
                        @if($OrdenPago->payments[$y]->data_puc->naturaleza % 2 == 0)
                            <?php
                                $valuesD[] = $OrdenPago->payments[$y]->valor;
                            ?>
                            <td>$<?php echo number_format($OrdenPago->payments[$y]->valor,0);?></td>
                            <td>$0</td>
                        @else
                            <?php
                            $valuesC[] = $OrdenPago->payments[$y]->valor;
                            ?>
                            <td>$0</td>
                            <td>$<?php echo number_format($OrdenPago->payments[$y]->valor,0);?></td>
                        @endif
                    </tr>
                @endfor
                @for($z = 0; $z < $OrdenPago->pucs->count(); $z++)
                    <tr class="text-center">
                        <?php
                        $valorTot = $OrdenPago->pucs[$z]->valor - $OrdenPagoDescuentos->sum('valor');
                        ?>
                        <td>{{$OrdenPago->pucs[$z]->data_puc->codigo}}</td>
                        <td>{{$OrdenPago->pucs[$z]->data_puc->nombre_cuenta}}</td>
                        <td>{{ $OrdenPago->registros->persona->num_dc }} {{ $OrdenPago->registros->persona->nombre }}</td>
                        @if($OrdenPago->pucs[$z]->data_puc->naturaleza % 2 == 0)
                            <?php
                            $valuesD[] = $valorTot;
                            ?>
                            <td>$<?php echo number_format($valorTot,0);?></td>
                            <td>$0</td>
                        @else
                            <?php
                            $valuesC[] = $valorTot;
                            ?>
                            <td>$0</td>
                            <td>$<?php echo number_format($valorTot,0);?></td>
                        @endif
                    </tr>
                @endfor
                <tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
                    <td colspan="3"><b>Total</b></td>

                    @if(isset($valuesD))
                        <td><b>$<?php echo number_format(array_sum($valuesD),0);?></b></td>
                    @else
                        <td><b>$0</b></td>
                    @endif
                    @if(isset($valuesC))
                        <td><b>$<?php echo number_format(array_sum($valuesC),0);?></b></td>
                    @else
                        <td><b>$0</b></td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
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
                @for($y = 0; $y < count($OrdenPago->payments); $y++)
                    <tr class="text-center">
                        <td>{{ $OrdenPago->payments[$y]->data_puc->codigo }}</td>
                        <td>{{ $OrdenPago->payments[$y]->data_puc->nombre_cuenta }}</td>
                        @if($OrdenPago->payments[$y]->type_pay == "ACCOUNT")
                            @php( $date = strftime("%d of %B %Y", strtotime($OrdenPago->payments[$y]->created_at)))
                            <td> Núm Cuenta: {{$OrdenPago->payments[$y]->num}} - Fecha: {{$date}}</td>
                        @elseif($OrdenPago->payments[$y]->type_pay == "CHEQUE")
                            @php( $date = strftime("%d of %B %Y", strtotime($OrdenPago->payments[$y]->created_at)))
                            <td> Núm Cheque: {{$OrdenPago->payments[$y]->num}} - Fecha: {{$date}}</td>
                        @endif
                        <td>$<?php echo number_format($OrdenPago->payments[$y]->valor,0);?></td>
                    </tr>
                @endfor
                <tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
                    <td colspan="3"><b>Total</b></td>
                    <td><b>$<?php echo number_format($OrdenPago->payments->sum('valor'),0);?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @stop
