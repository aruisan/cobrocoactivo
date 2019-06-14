@extends('layouts.dashboard')
@section('titulo')
    Contabilización de Orden de Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/ordenPagos/'.$ordenPago->id) }}" class="btn btn-success">
            <span class="hide-menu">Orden de Pago</span></a>
    </li>
    <br>
    <div class="card">
        <br>
        <center>
            <h4><b>Estado Actual del Registro</b></h4>
            <br>
            Valor Registro: $<?php echo number_format($ordenPago->registros->valor,0) ?>
            <br>
            Valor Total(+IVA): $<?php echo number_format($ordenPago->registros->val_total,0) ?>
            <br>
        </center>
        <br>
        <center>
            <h4><b>Valor Total de Descuentos</b></h4>
            <br>
            $<?php echo number_format($ordenPago->descuentos->sum('valor'),0) ?>
        </center>
        <br>
    </div>
    </div>
@stop
@section('content')
    <div class="col-md-12 align-self-center" id="crud">
        <div class="row justify-content-center">
            <br>
            <center><h2>Contabilización Orden de Pago: {{ $ordenPago->nombre }}</h2></center>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">
                    Registro Seleccionado: {{ $ordenPago->registros->objeto }}
                </div>
                <div class="col-md-6 text-center">
                    Tercero: {{ $ordenPago->registros->persona->nombre }}
                </div>
            </div>
            <br>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/ordenPagos/liquidacion/store')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {!! method_field('PUT') !!}
                    {{ csrf_field() }}
                    <input type="hidden" id="ordenPago_id" name="ordenPago_id" value="{{ $ordenPago->id }}">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabla">
                            <thead>
                            <th class="text-center">Codigo Cuenta</th>
                            <th class="text-center">Nombre Cuenta</th>
                            <th class="text-center">Debito</th>
                            <th class="text-center">Credito</th>
                            </thead>
                            <tbody>
                            @for($i=0;$i< count($ordenPagoDesc); $i++)
                                <tr>
                                    @if($ordenPagoDesc[$i]->retencion_fuentes_id == null)
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_municipales->codigo }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_retencion->codigo }}
                                        </td>
                                    @endif
                                    @if($ordenPagoDesc[$i]->retencion_fuentes_id == null)
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_municipales->cuenta }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ $ordenPagoDesc[$i]->descuento_retencion->cuenta }}
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <input type="text" value="$ 0" style="text-align:center" disabled>
                                    </td>
                                    <td class="text-center">
                                        <input type="text" value="$<?php echo number_format($ordenPagoDesc[$i]->valor,0) ?>" style="text-align:center" disabled>
                                    </td>
                                </tr>
                            @endfor
                            <tr>
                                <td>
                                    <select class="form-control" id="PUC" onchange="llenar()" name="PUC" required>
                                        <option>Selecciona un PUC</option>
                                        @foreach($PUCs as $puc)
                                            <option value="{{$puc->id}}">{{$puc->codigo}} - {{$puc->nombre_cuenta}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="user" name="userPuc" style="display: none">
                                        <option>Seleccionar Tercero Para el PUC</option>
                                        @foreach($Usuarios as $usuario)
                                            <option value="{{$usuario['id']}}">{{$usuario['name']}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" id="nameU" disabled style="display: none" style="text-align:center">
                                </td>
                                <td>
                                    <input type="number" style="text-align:center" name="valorPuc" id="valorPuc" value="" onchange="total()" required>
                                </td>
                                <?php
                                $result = $registro->val_total - $ordenPagoDesc->sum('valor')
                                ?>
                                <td>
                                    <input type="text" value="$<?php echo number_format($result,0) ?>" style="text-align:center" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2" style="vertical-align: middle"><b>Totales. (Recuerde que deben dar sumas iguales)</b></td>
                                <td>
                                    <input type="text" id="sumaD" style="text-align:center" disabled >
                                </td>
                                <td class="text-center" style="vertical-align: middle"><b>$<?php echo number_format($registro->val_total,0) ?></b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="col-md-12 align-self-center text-center">
                        <br>
                        <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i>&nbsp; Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });

        var Data = {
            @foreach($PUCs as $key => $data)
                @if($data->persona != null)
                    "{{$data->id}}":["{{$data->persona->nombre}}"],
                @else
                    "{{$data->id}}":["vacio"],
                @endif
            @endforeach
        };


        function llenar(){
            var select = document.getElementById('PUC');
            var opcion = select.value;
            var users= document.getElementById('user');
            var text= document.getElementById('nameU');

            if (Data[opcion][0]=="vacio"){
                text.style.display = 'none';
                users.style.display = 'inline';
            } else {
                users.style.display = 'none';
                text.style.display = 'inline';
                document.getElementById('nameU').value = Data[opcion][0];
            }
        }

        function total() {
            var Puc = document.getElementById('valorPuc');
            document.getElementById('sumaD').value = Puc.value;
        }
    </script>
@stop
