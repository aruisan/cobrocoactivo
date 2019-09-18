@extends('layouts.dashboard')
@section('titulo')
    Creación Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos') }}" class="btn btn-success">
            <span class="hide-menu">Pagos</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nuevo Pago</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/pagos')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-12 text-center">
                        <h2>Seleccione la orden de pago correspondiente:</h2>
                    </div>
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="tabla_OrdenesPago">
                                <thead>
                                <tr>
                                    <th class="text-center"><i class="fa fa-hashtag"></i></th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Tercero</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Saldo</th>
                                    <th class="text-center hidden">Valor</th>
                                    <th class="text-center hidden">Valor</th>
                                    <th class="text-center hidden">iva</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ordenPagos as $key => $data)
                                    <tr onclick="ver('col{{$data->id}}','Obj{{$data->nombre}}','Name{{$data->registros->persona->nombre}}','Val{{$data->saldo}}','ValTo{{$data->valor}}','Iva{{$data->iva}}');" style="cursor:pointer">
                                        <td id="col{{$data->id}}" class="text-center">{{ $data->id }}</td>
                                        <td id="Obj{{$data->nombre}}" class="text-center">{{ $data->nombre }}</td>
                                        <td id="Name{{$data->registros->persona->nombre}}" class="text-center">{{ $data->registros->persona->nombre }}</td>
                                        <td class="text-center">$<?php echo number_format($data->valor,0) ?></td>
                                        <td class="text-center">$<?php echo number_format($data->saldo,0) ?></td>
                                        <td id="Val{{$data->saldo}}" class="text-center hidden">{{ $data->saldo }}</td>
                                        <td id="ValTo{{$data->valor}}" class="text-center hidden">{{ $data->valor }}</td>
                                        <td id="Iva{{$data->iva}}" class="text-center hidden">{{ $data->iva }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none; background-color: white" id="form" name="form">
                        <hr>
                        <center>
                            <h3>Pagar</h3>
                        </center>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label class="control-label text-right col-md-4">Nombre Orden de Pago: </label>
                                <input type="text" style="text-align: center" class="form-control" name="Objeto" id="Objeto" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-right col-md-4">Valor de Orden de Pago: </label>
                                <input type="number" style="text-align: center" class="form-control" name="ValTo" id="ValTo" disabled>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label text-right col-md-4">Tercero Orden de Pago: </label>
                                <input type="text" style="text-align: center" class="form-control" name="Name" id="Name" disabled>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <input type="hidden" name="IdOP" id="IdOP">
                        <input type="hidden" name="ValTo" id="ValTo">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
@section('js')
    <script type="text/javascript">
        $('#tabla_OrdenesPago').DataTable( {
            responsive: true,
            "searching": false,
            "pageLength": 5
        } );

        $(document).ready(function() {
            var table = $('#tabla_OrdenesPago').DataTable();

            $('#tabla_OrdenesPago tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            $('#button').click( function () {
                table.row('.selected').remove().draw( false );
            } );

            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });
        } );

        function ver(col, Obj, Name, Val, ValTo, Iva){
            content = document.getElementById(col);
            var Obj = document.getElementById(Obj);
            var Name = document.getElementById(Name);
            var Val = document.getElementById(Val);
            var ValTo = document.getElementById(ValTo);
            var Iva = document.getElementById(Iva);
            var data = content.innerHTML;
            if (data) {
                $("#form").show();
                $("#Objeto").val(Obj.innerHTML);
                $("#Name").val(Name.innerHTML);
                $("#Val").val(Val.innerHTML);
                $("#ValOP").val(ValTo.innerHTML);
                $("#ValTo").val(ValTo.innerHTML);
                $("#iva").val(Iva.innerHTML);
                $("#ValIOP").val(Iva.innerHTML);
                $("#IdR").val(content.innerHTML);
                $("#ValTOP").val(Val.innerHTML);
                $("#ValS").val(Val.innerHTML);
            } else {
                $("#form").hide();
            }
        }

        function sumar() {

            var num1 = document.getElementById("ValOP").value;
            var num2 = document.getElementById("ValIOP").value;

            var resultado = parseInt(num1) + parseInt(num2);
            document.getElementById("ValTOP").value = resultado;
        }

        new Vue({
            el: '#table_bank',

            methods:{

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
                        '                                <input type="number" required class="form-control" name="val[]" min="0" style="text-align:center">\n' +
                        '                            </td>\n' +
                        '                            <td class="text-center"><button type="button" class="btn-sm btn-danger borrar">&nbsp;-&nbsp; </button></td></tr>');

                }
            }
        });


    </script>
@stop
