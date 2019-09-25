@extends('layouts.dashboard')
@section('titulo')
    Bancos
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos') }}" class="btn btn-success">
            <span class="hide-menu">Pagos</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Bancos</h2></center>
            <br>
            <div class="row">
                <div class="col-md-4 text-center">
                    Orden de Pago: {{ $pago->orden_pago->nombre }}
                </div>
                <div class="col-md-4 text-center">
                    <b>Monto a Pagar: $<?php echo number_format($pago->valor,0) ?></b>
                </div>
                <div class="col-md-4 text-center">
                    Tercero: {{ $pago->orden_pago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/pagos/banks/store')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <input type="hidden" name="ordenPago_id" value="{{ $pago->orden_pago->id }}">
                    <input type="hidden" name="pago_id" value="{{ $pago->id }}">

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
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#tabla_Pago').DataTable( {
            responsive: true,
            "searching": false
        } );

        $(document).ready(function() {
            $('#button').click( function () {
                table.row('.selected').remove().draw( false );
            } );

            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });
        } );

        new Vue({
            el: '#table_bank',

            methods:{

                nuevoBanco: function(){
                    var nivel=parseInt($("#banks tr").length);
                    $('#banks tbody tr:last').after('<tr><td>\n' +
                        '                                <select class="form-control" name="banco[]" required>\n' +
                        '                                    @foreach($PUCS as $puc)\n' +
                        '                                        <option value="{{$puc->id}}">{{$puc->codigo}} - {{$puc->nombre_cuenta}}</option>\n' +
                        '                                    @endforeach\n' +
                        '                                </select>\n' +
                        '                            </td>\n' +
                        '                            <td>\n' +
                        '                                <input type="number" required class="form-control" name="val[]" min="0" style="text-align:center">\n' +
                        '                            </td>\n' +
                        '                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td></tr>');

                }
            }
        });
    </script>
@stop
