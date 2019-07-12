@extends('layouts.dashboard')
@section('titulo')
    Pagar Orden de Pago
@stop
@section('sidebar')
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Valor Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($OP->valor > 0)
                $<?php echo number_format($OP->valor,0) ?>
            @else
                $0.00
            @endif
        </div>
        <center>
            <h4><b>Valor Disponible Orden de Pago</b></h4>
        </center>
        <div class="text-center">
            @if($OP->saldo > 0)
                $<?php echo number_format($OP->saldo,0) ?>
            @else
                $0.00
            @endif
        </div>
        <br>
    </div>
    <br>
    @if($OP->estado == 0)
    @else
    <li> <a href="{{ url('/administrativo/ordenPagos/descuento/create/'.$OP->id) }}" class="btn btn-primary"><span class="hide-menu">Descuentos</span></a></li>
    <li> <a href="{{ url('/administrativo/ordenPagos/liquidacion/create/'.$OP->id) }}" class="btn btn-success"><span class="hide-menu"><i class="fa fa-credit-card"></i>&nbsp; Liquidar</span></a></li>
    @endif
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <center><h3>Orden de Pago: {{ $OP->nombre }}</h3></center>
            <div class="form-validation">
                <form class="form" action="">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Nombre:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $OP->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Registro:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $OP->registros->objeto }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="nombre">Tercero:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" name="name" style="text-align:center" value="{{ $OP->registros->persona->nombre }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-right col-md-4" for="valor">Fecha de Creación:</label>
                            <div class="col-lg-6">
                                <input type="text" disabled class="form-control" style="text-align:center" name="valor" value="{{ $OP->created_at }}">
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
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Debito</th>
                    <th class="text-center">Credito</th>
                </tr>
                </thead>
                <tbody>
                @foreach($OP->descuentos as  $PagosDesc)
                    <tr class="text-center">
                        <td>{{ $PagosDesc->nombre }}</td>
                        <td>$ 0</td>
                        <td>$ <?php echo number_format($PagosDesc['valor'],0);?></td>
                    </tr>
                @endforeach
                <tr class="text-center" style="background-color: rgba(19,165,255,0.14)">
                    <td><b>Total Descuentos</b></td>
                    <td><b>$ 0</b></td>
                    <td><b>$ <?php echo number_format($OP->descuentos->sum('valor'),0);?></b></td>
                </tr>
                @foreach($OP->pucs as  $Pucs)
                    <tr class="text-center">
                        <td>{{ $Pucs->data_puc->nombre_cuenta }}</td>
                        <td>$ <?php echo number_format($Pucs->valor_debito,0);?></td>
                        <td>$ <?php echo number_format($Pucs->valor_credito,0);?></td>
                    </tr>
                @endforeach
                <?php
                $val = $OP->valor - $OP->descuentos->sum('valor');
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <center>
            <h3>Pagar</h3>
        </center>
        <hr>
        <br>
        <div class="col-md-12 align-self-center" style="background-color: white">
            <form class="form-validation" action="{{url('/administrativo/ordenPagos/pay/store')}}" method="POST" enctype="multipart/form-data">
                {!! method_field('PUT') !!}
                {{ csrf_field() }}
                <input type="hidden" name="OP" value="{{ $OP->id }}">
                <input type="hidden" name="Pay" value="{{ $val }}">
                <div class="col-md-4 align-self-center">
                    <div class="form-group">
                        <select class="form-control" id="form_pay" name="type_pay" onchange="var date= document.getElementById('fecha'); var cheque = document.getElementById('cheque'); var tarjeta = document.getElementById('tarjeta'); var bank = document.getElementById('table_bank'); if(this.value=='1'){ fecha.style.display='inline'; cheque.style.display='inline'; bank.style.display='inline'; tarjeta.style.display='none';}else if(this.value=='2'){ fecha.style.display='inline'; cheque.style.display='none'; bank.style.display='inline'; tarjeta.style.display='inline';}else{fecha.style.display='none'; bank.style.display='none'; cheque.style.display='none'; tarjeta.style.display='none'; }">
                            <option>Selecciona Forma de Pago</option>
                            <option value="1">Cheque</option>
                            <option value="2">Transferencia</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 align-self-center" id="fecha" style="display: none">
                    <div class="form-group">
                        <label class="control-label text-right col-md-4" for="formadepago">Fecha:</label>
                        <div class="col-lg-6">
                            <input type="date" disabled class="form-control" name="ff" style="text-align:center" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 align-self-center" id="cheque" style="display: none">
                    <div class="form-group">
                        <label class="control-label text-right col-md-4" for="formadepago">Número de Cheque:</label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" name="num_cheque" style="text-align:center">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 align-self-center" id="tarjeta" style="display: none">
                    <div class="form-group">
                        <label class="control-label text-right col-md-4" for="formadepago">Número de Cuenta:</label>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" name="num_cuenta" style="text-align:center">
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive" id="table_bank" style="display: none">
                    <br>
                    <table class="table table-bordered" id="banks">
                        <thead>
                        <tr>
                            <th class="text-center">Banco</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center"><i class="fa fa-trash-o"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="banco[]" required>
                                    <option>Selecciona un Banco del PUC</option>
                                    @foreach($PUCS as $puc)
                                        <option value="{{$puc->id}}">{{$puc->codigo}} - {{$puc->nombre_cuenta}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" required class="form-control" name="val[]" min="0" style="text-align:center">
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <br>
                    <center>
                        <button type="button" v-on:click.prevent="nuevoBanco" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Agregar Otro Banco</button>
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-usd"></i><i class="fa fa-arrow-right"></i>&nbsp; &nbsp; Pagar</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
    @stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#tablaDesc').DataTable( {
                responsive: true,
                order: false,
                "searching": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            } );
        } );

        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });

        new Vue({
            el: '#table_bank',

            methods:{

                eliminar: function(dato){
                    var urlcdpsRegistro = '/administrativo/cdpsRegistro/'+dato;
                    axios.delete(urlcdpsRegistro).then(response => {
                        location.reload();
                    });
                },

                eliminarV: function(dato){
                    var urlCdpRegistrosValor = '/administrativo/cdpsRegistro/valor/'+dato;
                    axios.delete(urlCdpRegistrosValor).then(response => {
                        location.reload();
                    });
                },

                nuevoBanco: function(){
                    var nivel=parseInt($("#banks tr").length);
                    $('#banks tbody tr:last').after('<tr><td>\n' +
                        '                                <select class="form-control" name="banco[]" required>\n' +
                        '                                    <option>Selecciona un Banco del PUC</option>\n' +
                        '                                    @foreach($PUCS as $puc)\n' +
                        '                                        <option value="{{$puc->id}}">{{$puc->codigo}} - {{$puc->nombre_cuenta}}</option>\n' +
                        '                                    @endforeach\n' +
                        '                                </select>\n' +
                        '                            </td>\n' +
                        '                            <td>\n' +
                        '                                <input type="number" required class="form-control" name="val[]" min="0" max="{{$val}}" style="text-align:center">\n' +
                        '                            </td>\n' +
                        '                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td></tr>');

                }
            }
        });
    </script>
@stop
